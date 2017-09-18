<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('sitemap.xml', function(){
    // create new sitemap object
    $sitemap = App::make('sitemap');

    // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
    // by default cache is disabled
    $sitemap->setCache('laravel.sitemap', 12 * 60, true);

    // check if there is cached sitemap and build new only if is not
    if (! $sitemap->isCached()) {
        // add item to the sitemap (url, date, priority, freq)
//        $sitemap->add(URL::to('/'), null, null, 'daily');

        // add all offers to the sitemap
        $offers = \Penati\Offer::orderBy('created_at', 'desc')->get();
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
});

Route::get('/home', 'HomeController@index')->name('home');

if (env('APP_DEBUG')) {
    Route::prefix('_dev')->group(function () {
        Route::get('agent', 'DevController@agents');
        Route::get('offer', 'DevController@offers');
        //
        Route::get('{model}', 'DevController@index');
    });
}

Route::get('/', function () {
    return view('index');
});
Route::resource('agents', 'AgentController', ['only' => [
    'show'
]]);
Route::resource('agents/{agent}/offers', 'OfferController', ['only' => [
    'show'
]]);
