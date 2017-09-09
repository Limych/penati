<?php
/**
 * Created by PhpStorm.
 * User: Limych
 * Date: 06.09.2017
 * Time: 0:34
 */

namespace Penati\Console\Commands;

use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Penati\Agent;
use Penati\Object;
use Illuminate\Console\Command;
use Penati\Office;

class YandexXMLImport extends Command
{

    const YANDEX_NS = 'http://webmaster.yandex.ru/schemas/feed/realty/2010-06';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:yandex {feed_url?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Yandex XML feed of real-estate objects';

    protected static function normalizePrice($data)
    {
        $fmt = new \NumberFormatter('ru-RU', \NumberFormatter::CURRENCY);
        $fmt->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, 0);
        return $fmt->formatCurrency($data['value'], $data['currency']);
    }

    /**
     * Execute the console command.
     *
     * @param Application $app
     * @return mixed
     * @throws \Exception
     */
    public function handle(Application $app)
    {
        $feed = $this->argument('feed_url') ?: env('IMPORT_YANDEX');
        if (empty($feed)) {
            $this->error('Empty feed URL.');
            return 1;
        }

        $reader = new \XMLReader();
        $reader->open($feed);
        $reader->read();
        do {
            if ($reader->nodeType == \XMLReader::ELEMENT
                && ($reader->localName == 'offer') && ($reader->namespaceURI == self::YANDEX_NS)
            ) {
                try {
                    $this->readOffer($reader);
                } catch (\Exception $ex) {
                    if ($app->environment() !== 'production') {
                        throw $ex;
                    }
                }
            }
        } while ($reader->read());
        $reader->close();

        return 0;
    }

    protected function readOffer(\XMLReader $xml)
    {
        $id = null;
        $data = [];

        if ($xml->hasAttributes) {
            $moreAttributes = $xml->moveToFirstAttribute();
            while ($moreAttributes) {
                if ($xml->localName == 'internal-id') {
                    $id = intval($xml->value);
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
                            $child = $child . $xml->value;
                        }
                        $data[$key] = $child;
                        break;
                    case 'image':
                        $child = '';
                        while ($xml->read() && $xml->hasValue) {
                            $child = $child . $xml->value;
                        }
                        if (empty($data['images'])) {
                            $data['images'] = [];
                        }
                        $data['images'][] = $child;
                        break;
                    case 'last-update-date':
                        $child = '';
                        while ($xml->read() && $xml->hasValue) {
                            $child = $child . $xml->value;
                        }
                        $data[$key] = Carbon::createFromFormat(Carbon::ATOM, $child);
                        break;
                    case 'area':
                        $child = $this->readAssoc($xml);
                        $data[$key] = $child['value'] . ' м²';
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
                        self::skipElement($xml);
                        break;
                }
            }
            $xml->read(); // Advance the reader
        }

        if (empty($data['location']['latitude'])) {
            return;
        }

        $objectData = [
            'title' => Str::ucfirst($data['category']) . ' ' . $data['area'],
            'price' => $data['price'],
            'latitude' => $data['location']['latitude'],
            'longitude' => $data['location']['longitude'],
            'address' => $data['location']['address'],
            'agent_id' => $data['sales-agent']->id,
        ];
        if (! empty($data['images'])) {
            $objectData['badgeFPath'] = $data['images'][0];
        }

        Object::unguard();
        $object = Object::firstOrCreate([
            'id' => $id,
        ], $objectData);
        Object::unguard(false);

        if (! empty($object->updated_at) && $data['last-update-date']->gt($object->updated_at)) {
            unset($objectData['slug'], $objectData['title'], $objectData['badgeFPath']);
            $object->update($objectData);
        }

        $dir = 'objects/' . $id;
        foreach ($data['images'] as $image_url) {
            $fpath = $dir . '/' . basename($image_url);
            if (! Storage::disk('public')->exists($fpath)) {
                Storage::disk('public')->put($fpath, fopen($image_url, 'r'));
            }
        }
    }

    protected static function skipElement(\XMLReader $xml)
    {
        if (! $xml->isEmptyElement) {
            $xml->read();
            while ($xml->nodeType != \XMLReader::END_ELEMENT) {
                if ($xml->nodeType != \XMLReader::ELEMENT) {
                    // No-op: skip any insignificant whitespace, comments, etc.
                } else {
                    // Skip child element
                    self::skipElement($xml);
                }
                $xml->read(); // Advance the reader
            }
        }
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

    protected function readAgent(\XMLReader $xml)
    {
        $data = $this->readAssoc($xml);

        $agent = Agent::where('fullName', $data['name'])->first();
        if (empty($agent)) {
            $contacts = [];
            $tmp = is_array($data['phone']) ? $data['phone'] : [ $data['phone'] ];
            foreach ($tmp as $phone) {
                $contacts[] = self::phone2Uri($phone);
            }
            if (! empty($data['email'])) {
                $contacts[] = 'mailto:' . $data['email'];
            }

            $agent = Agent::where('contactUris', 'LIKE', "%$contacts[0]%")->first();

            if (empty($agent)) {
                $agent = new Agent([
                    'fullName' => $data['name'],
                    'displayName' => $data['name'],
                    'contactUris' => implode("\n", $contacts),
                ]);
                $office = Office::firstOrCreate([
                    'title' => $data['organization'],
                ], [
                    'contactUris' => '',
                ]);
                $agent->office()->associate($office);
                $agent->save();
            }
        }

        return $agent;
    }
}