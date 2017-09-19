<?php

namespace Penati\Http\Controllers;

use App;
use Illuminate\Support\Facades\View;
use Penati\Offer;
use URL;

class SitemapController extends Controller
{

    const CACHE_DURATION = 12 * 60; // Minutes

    /**
     * Display a sitemap listing.
     *
     * @return View
     */
    public function index()
    {
        // create new sitemap object
        $sitemap = App::make('sitemap');

        // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
        // by default cache is disabled
        $sitemap->setCache('laravel.sitemap', static::CACHE_DURATION, true);

        // check if there is cached sitemap and build new only if is not
        if (! $sitemap->isCached()) {
            // add item to the sitemap (url, date, priority, freq)
            $sitemap->add(URL::to('/'), null, null, 'daily');

            // add all offers to the sitemap
            $offers = Offer::orderBy('created_at', 'desc')->get();
            foreach ($offers as $offer)
            {
                $agent = $offer->agent()->first();
                $url = URL::route('offers.show', [
                    'agent' => $agent->slug,
                    'id' => $offer->slug,
                ]);
                $sitemap->add($url, $offer->updated_at);
            }
        }

        return $sitemap->render();
    }
}
