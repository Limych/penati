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

        Route::get('test', function () {
            return view('_dev.test');
        })->name('test');
    });
}

if (env('APP_DEBUG')) { // TODO: Убрать, когда будут проверена политика работы с персональными данными
    Route::prefix('about')->group(function () {
        Route::get('personal-data', function () {
            return view('about.personal-data');
        })->name('about_personal-data');
        Route::get('cookies', function () {
            return view('about.cookies');
        })->name('about_cookies');
    });
}

Route::get('adv-packages', function () {
    return view('adv-packages');
});

Route::get('/', function () {
    return view('index');
})->name('home');
Route::get('/home', 'HomeController@index')->name('dashboard');

// Agents
if (env('APP_DEBUG')) { // TODO: Убрать, когда будут сделаны страницы агентов
    Route::resource('agents', 'AgentController', ['only' => [
        'show',
    ]]);
}

// Offers
Route::get('offers/{id}', function ($id) {
    // Redirect external short link to right URL
    $offer = \Penati\Offer::whereForeignId($id)->firstOrFail();

    return redirect('agents/'.$offer->agent()->firstOrFail(['slug'])->slug.
        '/offers/'.$offer->slug);
});
Route::resource('agents/{agent}/offers', 'OfferController', ['only' => [
    'show',
]]);
