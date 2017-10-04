<?php
/**
 * Copyright (c) 2017 Andrey "Limych" Khrolenok <andrey@khrolenok.ru>.
 */

/**
 * Created by PhpStorm.
 * User: Limych
 * Date: 21.09.2017
 * Time: 0:00.
 */

namespace Penati\Console\Commands\FeedImporters;

use Penati\User;
use Penati\Offer;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Penati\ContentBlocks\PhotosContentBlock;
use Illuminate\Contracts\Foundation\Application;
use Penati\ContentBlocks\DescriptionContentBlock;

class YandexFeedImporter
{
    const YANDEX_NS = 'http://webmaster.yandex.ru/schemas/feed/realty/2010-06';

    /**
     * Check for ability to import real estate offers feed.
     *
     * @param \XMLReader $reader
     * @return bool
     */
    public function canImport(\XMLReader $reader)
    {
        return ($reader->nodeType == \XMLReader::ELEMENT)
            && ($reader->localName == 'realty-feed')
            && ($reader->namespaceURI == self::YANDEX_NS);
    }

    /**
     * Import real estate offers feed to database.
     *
     * @param Application $app
     * @param string $feed
     * @param \XMLReader $reader
     * @throws \Exception
     */
    public function import(Application $app, $feed, \XMLReader $reader)
    {
        do {
            if ($reader->nodeType == \XMLReader::ELEMENT
                && ($reader->localName == 'offer') && ($reader->namespaceURI == self::YANDEX_NS)
            ) {
                try {
                    $this->readOffer($feed, $reader);
                } catch (\Exception $ex) {
                    if ($app->environment() !== 'production') {
                        throw $ex;
                    }
                }
            }
        } while ($reader->read());
    }

    /**
     * Make human readable price.
     *
     * @param $data
     * @return string
     */
    protected static function normalizePrice($data)
    {
        $fmt = new \NumberFormatter('ru-RU', \NumberFormatter::CURRENCY);
        $fmt->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, 0);

        return $fmt->formatCurrency($data['value'], $data['currency']);
    }

    /**
     * Read offer from feed and add it to database.
     *
     * @param $feed_url
     * @param \XMLReader $xml
     */
    protected function readOffer($feed_url, \XMLReader $xml)
    {
        $data = [];

        if ($xml->hasAttributes) {
            $moreAttributes = $xml->moveToFirstAttribute();
            while ($moreAttributes) {
                if ($xml->localName == 'internal-id') {
                    $foreign_id = intval($xml->value).'@'.parse_url($feed_url, PHP_URL_HOST);
                }
                $moreAttributes = $xml->moveToNextAttribute();
            }
        }

        $xml->read();
        while ($xml->nodeType != \XMLReader::END_ELEMENT) {
            if ($xml->nodeType != \XMLReader::ELEMENT) {
                // No-op: skip any insignificant whitespace, comments, etc.
            } elseif ($xml->namespaceURI == self::YANDEX_NS) {
                switch ($key = $xml->localName) {
                    case 'type':
                    case 'property-type':
                    case 'category':
                    case 'description':
                    case 'rooms':
                        $child = '';
                        while ($xml->read() && $xml->hasValue) {
                            $child = $child.$xml->value;
                        }
                        $data[$key] = $child;
                        break;
                    case 'image':
                        $child = '';
                        while ($xml->read() && $xml->hasValue) {
                            $child = $child.$xml->value;
                        }
                        if (empty($data['images'])) {
                            $data['images'] = [];
                        }
                        $data['images'][] = $child;
                        break;
                    case 'last-update-date':
                        $child = '';
                        while ($xml->read() && $xml->hasValue) {
                            $child = $child.$xml->value;
                        }
                        $data[$key] = Carbon::createFromFormat(Carbon::ATOM, $child);
                        break;
                    case 'area':
                        $child = $this->readAssoc($xml);
                        $data[$key] = $child['value'].' м²';
                        break;
                    case 'price':
                        $data[$key] = self::normalizePrice($this->readAssoc($xml));
                        break;
                    case 'location':
                        $child = $this->readAssoc($xml);
                        $last = null;
                        $tmp = [];
                        foreach (['country', 'region', 'locality-name', 'sub-locality-name', 'non-admin-sub-locality', 'address'] as $key2) {
                            if (! empty($child[$key2]) && ($last !== $child[$key2])) {
                                $tmp[] = $last = $child[$key2];
                            }
                            unset($child[$key2]);
                        }
                        $child['address'] = implode(', ', $tmp);
                        $data[$key] = $child;
                        break;
                    case 'sales-agent':
                        $data[$key] = $this->readAgent($xml);
                        break;
                    default:
                        $xml->next();
                        continue;
                }
            }
            $xml->read(); // Advance the reader
        }

        if (empty($foreign_id) || empty($data['location']['latitude'])) {
            return;
        }

        $objectData = [
            'title' => Str::ucfirst($data['category']).' '.$data['area'],
            'price' => $data['price'],
            'latitude' => $data['location']['latitude'],
            'longitude' => $data['location']['longitude'],
            'address' => $data['location']['address'],
        ];
        if (! empty($data['images'])) {
            $objectData['badgeFPath'] = $data['images'][0];
        }

        /** @var Offer $offer */
        $offer = Offer::withoutGlobalScope('expire')->firstOrNew([
            'foreign_id' => $foreign_id,
        ], $objectData);
        $offer->agent()->associate($data['sales-agent']);

        if (! empty($offer->updated_at)) {
            unset($objectData['slug'], $objectData['title'], $objectData['badgeFPath']);
            $offer->update($objectData);
        }
        $offer->touch();

        if (! empty($data['description'])) {
            static::updateBlock($offer, DescriptionContentBlock::class, [
                    'title' => Str::ucfirst($data['category']).' '.$data['area'],
                    'summary' => $data['location']['address'],
                    'content' => $data['description'],
            ]);
        }
        if (! empty($data['images'])) {
            static::updateBlock($offer, PhotosContentBlock::class, [
                'title' => 'Фотогалерея объекта',
                'content' => implode("\n", $data['images']),
            ]);
        }
    }

    /**
     * @param Offer $offer
     * @param string $model_class
     * @param $attributes
     * @internal param array $blocks
     */
    protected static function updateBlock($offer, $model_class, $attributes)
    {
        foreach ($offer->contentBlocks()->getModels() as $block) {
            if (get_class($block) === $model_class) {
                // Update existing block
                $block->update($attributes);
                $block->touch();

                return;
            }
        }

        // Create new block
        $offer->contentBlocks()->save(new $model_class($attributes));
    }

    protected function readAssoc(\XMLReader $xml)
    {
        $data = [];

        $xml->read();
        while ($xml->nodeType != \XMLReader::END_ELEMENT) {
            if ($xml->nodeType != \XMLReader::ELEMENT) {
                // No-op: skip any insignificant whitespace, comments, etc.
            } else {
                $key = $xml->localName;
                $child = '';
                while ($xml->read() && $xml->hasValue) {
                    $child = $child.$xml->value;
                }
                if (empty($data[$key])) {
                    $data[$key] = $child;
                } elseif (is_array($data[$key])) {
                    $data[$key][] = $child;
                } else {
                    $data[$key] = [
                        $data[$key],
                        $child,
                    ];
                }
            }
            $xml->read(); // Advance the reader
        }

        return $data;
    }

    protected static function phone2Uri($phone)
    {
        $tmp = preg_replace("/[^\d+]+/", '', $phone);
        if (preg_match("/^(?:\+7|8)(\d{3})(\d{3})(\d{2})(\d{2})$/", $tmp, $matches)) {
            $phone = "+7-$matches[1]-$matches[2]-$matches[3]-$matches[4]";
        } else {
            $phone = trim(preg_replace("/[^\d+().-]+/", '-', $phone), '-');
        }

        return 'tel:'.$phone;
    }

    protected function readAgent(\XMLReader $xml)
    {
        $data = $this->readAssoc($xml);

        $agent = User::whereName($data['name'])->first();
        if (empty($agent)) {
            $contacts = [];
            $tmp = is_array($data['phone']) ? $data['phone'] : [$data['phone']];
            foreach ($tmp as $phone) {
                $contacts[] = static::phone2Uri($phone);
            }
            if (! empty($data['email'])) {
                $contacts[] = 'mailto:'.$data['email'];
            }

            $agent = User::where('contactUris', 'LIKE', "%$contacts[0]%")->first();

            if (empty($agent)) {
                $agent = User::create([
                    'name' => $data['name'],
                    'email' => Uuid::uuid4(),
                    'password' => bcrypt(str_random(12)),
                    'contactUris' => implode("\n", $contacts),
                ]);
                \Bouncer::assign('agent')->to($agent);
            }
        }

        return $agent;
    }
}
