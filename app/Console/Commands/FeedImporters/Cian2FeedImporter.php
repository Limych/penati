<?php
/**
 * Copyright (c) 2017 Andrey "Limych" Khrolenok <andrey@khrolenok.ru>
 */

/**
 * Created by PhpStorm.
 * User: Limych
 * Date: 21.09.2017
 * Time: 0:00
 */

namespace Penati\Console\Commands\FeedImporters;

use Illuminate\Contracts\Foundation\Application;
use Penati\ContentBlocks\DescriptionContentBlock;
use Penati\ContentBlocks\PhotosContentBlock;
use Penati\Offer;
use Penati\User;
use Ramsey\Uuid\Uuid;

class Cian2FeedImporter
{

    /**
     * Check for ability to import real estate offers feed
     *
     * @param \XMLReader $reader
     * @return boolean
     */
    public function canImport(\XMLReader $reader)
    {
        if (($reader->nodeType != \XMLReader::ELEMENT) || ($reader->localName != 'feed')) {
            return false;
        }
        $reader2 = new \XMLReader();
        $reader2->XML($reader->readOuterXml());
        $reader2->read();
        do {} while ($reader2->read() && $reader2->nodeType != \XMLReader::ELEMENT);
        if ($reader2->localName !== 'feed_version') {
            $reader2->close();
            return false;
        }
        $reader2->read();
        if (! $reader2->hasValue || ($reader2->value != 2)) {
            $reader2->close();
            return false;
        }
        $reader2->close();
        return true;
    }

    /**
     * Import real estate offers feed to database
     *
     * @param Application $app
     * @param string $feed
     * @param \XMLReader $reader
     * @throws \Exception
     */
    public function import(Application $app, $feed, \XMLReader $reader)
    {
        do {
            if ($reader->nodeType == \XMLReader::ELEMENT && ($reader->localName == 'object')) {
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
     * Make human readable price
     *
     * @param $data
     * @return string
     */
    protected static function normalizePrice($data)
    {
        if (strtoupper($data['Currency']) == 'RUR') {
            $data['Currency'] = 'RUB';
        }
        $fmt = new \NumberFormatter('ru-RU', \NumberFormatter::CURRENCY);
        $fmt->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, 0);
        return $fmt->formatCurrency($data['Price'], $data['Currency']);
    }

    /**
     * Read offer from feed and add it to database
     *
     * @param $feed_url
     * @param \XMLReader $xml
     */
    protected function readOffer($feed_url, \XMLReader $xml)
    {
        $data = [];

        $xml->read(); // Advance the reader
        while ($xml->nodeType != \XMLReader::END_ELEMENT) {
            if ($xml->nodeType != \XMLReader::ELEMENT) {
                // No-op: skip any insignificant whitespace, comments, etc.
            } else {
                switch ($key = $xml->localName) {
                    default:
                        $xml->next();
//                        dd($xml->localName);
                        continue;
                    case 'ExternalId':
                        $child = '';
                        while ($xml->read() && $xml->hasValue) {
                            $child = $child . $xml->value;
                        }
                        $foreign_id = intval($child) . '@' . parse_url($feed_url, PHP_URL_HOST);
                        break;
                    case 'Category':
                    case 'Description':
                    case 'Address':
                    case 'IsApartments':
                    case 'IsPenthouse':
                    case 'TotalArea':
                    case 'BedroomsCount':
                    case 'FlatRoomsCount':
                    case 'FloorNumber':
                        $child = '';
                        while ($xml->read() && $xml->hasValue) {
                            $child = $child . $xml->value;
                        }
                        $data[$key] = $child;
                        break;
                    case 'Coordinates':
                    case 'SubAgent':
                    case 'BargainTerms':
                        $data[$key] = $this->readAssoc($xml);
                        break;
                    case 'Phones':
                        $data[$key] = $this->readPhones($xml);
                        break;
                    case 'Photos':
                    case 'LayoutPhoto':
                        $data[$key] = $this->readPhotos($xml);
                        break;
                }
            }
            $xml->read(); // Advance the reader
        }

        if (empty($foreign_id) || empty($data['Coordinates']['Lat'])) {
            return;
        }

        $isRent = false !== strpos($data['Category'], 'Rent');
        switch ($data['Category']) {
            case 'houseSale':
            case 'houseRent':
            case 'cottageSale':
            case 'cottageRent':
                $cover = ! $isRent ? "Продаётся дом" : "Дом в аренду";
                if (! empty($data['SettlementName'])) {
                    $cover .= " в посёлке \"${data['SettlementName']}\"";
                }
                $title = "Дом площадью ${data['TotalArea']} м² с ${data['BedroomsCount']} спальн" .
                    static::plural(['ей', 'ями'], $data['BedroomsCount']);
                break;
            case 'flatSale':
            case 'flatRent':
                if (! empty($data['IsPenthouse'])) {
                    $cover = !$isRent ? "Продаётся пентхаус" : "Пентхаус в аренду";
                    $title = "${data['FlatRoomsCount']}-комнатный пентхаус, ${data['TotalArea']} м²";
                } elseif (! empty($data['IsApartments'])) {
                    $cover = !$isRent ? "Продаются апартаменты" : "Квартира в аренду";
                    $title = "${data['FlatRoomsCount']}-комнатная квартира, ${data['TotalArea']} м²." .
                        " ${data['FloorNumber']} этаж";
                } else {
                    $cover = !$isRent ? "Продаётся квартира" : "Квартира в аренду";
                    $title = "${data['FlatRoomsCount']}-комнатная квартира, ${data['TotalArea']} м²." .
                        " ${data['FloorNumber']} этаж";
                }
                break;
            default:
dd($data['Category']);
                return;
        }
        $objectData = [
            'title' => $cover,
            'price' => static::normalizePrice($data['BargainTerms']) . ($isRent ? '/мес.' : ''),
            'latitude' => $data['Coordinates']['Lat'],
            'longitude' => $data['Coordinates']['Lng'],
            'address' => $data['Address'],
        ];
        if (! empty($data['Photos'])) {
            $objectData['badgeFPath'] = $data['Photos'][0];
        }

        $agent = $this->getAgent($data);

        /** @var Offer $offer */
        $offer = Offer::firstOrNew([
            'foreign_id' => $foreign_id,
        ], $objectData);
        $offer->agent()->associate($agent);

        if (! empty($offer->updated_at)) {
            unset($objectData['slug'], $objectData['title'], $objectData['badgeFPath']);
            $offer->update($objectData);
        }
        $offer->touch();

        if (! empty($data['Description'])) {
            static::updateBlock($offer, DescriptionContentBlock::class, [
                    'title' => $title,
                    'summary' => $data['Address'],
                    'content' => $data['Description'],
            ]);
        }
        if (! empty($data['Photos'])) {
            static::updateBlock($offer, PhotosContentBlock::class, [
                'title' => 'Фотогалерея объекта',
                'content' => implode("\n", $data['Photos']),
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
                    $child = $child . $xml->value;
                }
                if (empty($data[$key])) {
                    $data[$key] = $child;
                } elseif (is_array($data[$key])) {
                    $data[$key][] = $child;
                } else {
                    $data[$key] = [
                        $data[$key],
                        $child
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
        return 'tel:' . $phone;
    }

    protected function getAgent($data)
    {
        $agent_name = trim($data['SubAgent']['FirstName'] . ' ' . $data['SubAgent']['LastName']);
        $agent = User::whereName($agent_name)->first();
        if (empty($agent)) {
            $contacts = [];
            $tmp = [];
            if (! empty($data['SubAgent']['Phone'])) {
                $tmp[] = $data['SubAgent']['Phone'];
            }
            if (! empty($data['Phones'])) {
                $tmp = array_merge($tmp, $data['Phones']);
            }
            foreach ($tmp as $phone) {
                $contacts[] = static::phone2Uri($phone);
            }
            if (! empty($data['Email'])) {
                $contacts[] = 'mailto:' . $data['Email'];
            }

            $agent = User::where('contactUris', 'LIKE', "%$contacts[0]%")->first();

            if (empty($agent)) {
                $agent = User::create([
                    'name' => $agent_name,
                    'email' => Uuid::uuid4(),
                    'password' => bcrypt(str_random(12)),
                    'contactUris' => implode("\n", $contacts),
                ]);
                \Bouncer::assign('agent')->to($agent);
            }
        }

        return $agent;
    }

    protected function readPhones(\XMLReader $xml)
    {
        $phones = [];

        $xml->read();
        while ($xml->nodeType != \XMLReader::END_ELEMENT) {
            if ($xml->nodeType != \XMLReader::ELEMENT) {
                // No-op: skip any insignificant whitespace, comments, etc.
            } elseif($xml->localName == 'PhoneSchema') {
                $res = $this->readAssoc($xml);
                $phones[] = $res['CountryCode'] . $res['Number'];
            }
            $xml->read(); // Advance the reader
        }

        return $phones;
    }

    protected function readPhotos(\XMLReader $xml)
    {
        $photos = [];

        $xml->read();
        while ($xml->nodeType != \XMLReader::END_ELEMENT) {
            if ($xml->nodeType != \XMLReader::ELEMENT) {
                // No-op: skip any insignificant whitespace, comments, etc.
            } elseif($xml->localName == 'PhotoSchema') {
                $res = $this->readAssoc($xml);
                if ($res['IsDefault']) {
                    array_unshift($photos, $res['FullUrl']);
                } else {
                    $photos[] = $res['FullUrl'];
                }
            }
            $xml->read(); // Advance the reader
        }

        return $photos;
    }

    /**
     * Detect & return the ending for the plural word
     *
     * @param  array $endings  nouns or endings words for (1, 4, 5)
     * @param  integer $number   number rows to ending determine
     *
     * @return string
     *
     * @example:
     * {{ ['Остался %d час', 'Осталось %d часа', 'Осталось %d часов']|plural(11) }}
     * {{ count }} стат{{ ['ья','ьи','ей']|plural(count)
     */
    protected static function plural($endings, $number)
    {
        if (count($endings) == 2) {
            $endings[] = $endings[1];
        }
        $cases = [2, 0, 1, 1, 1, 2];
        $n = $number;
        return sprintf($endings[ ($n%100>4 && $n%100<20) ? 2 : $cases[min($n%10, 5)] ], $n);
    }
}
