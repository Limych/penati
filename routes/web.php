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

Route::get('sitemap.xml', 'SitemapController@index')->name('sitemap');

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
})->name('home');
Route::get('/home', 'HomeController@index');

// Agents
Route::resource('agents', 'AgentController', ['only' => [
    'show'
]]);

// Offers
Route::get('offers/{id}', function ($id) {
    // Redirect external short link to right URL
    $offer = \Penati\Offer::whereForeignId($id)->first();
    return redirect('agents/' . $offer->agent()->first([ 'slug' ])->slug .
        '/offers/' . $offer->slug);
});
Route::resource('agents/{agent}/offers', 'OfferController', ['only' => [
    'show'
]]);
