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

Route::get('/', function () {
    return view('office');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

if (env('APP_DEBUG')) {
    Route::prefix('_dev')->group(function () {
        Route::get('agent', 'DevController@agents');
        Route::get('offer', 'DevController@offers');
        Route::get('{model}', 'DevController@index');
    });
}

Route::resource('agents', 'AgentController', ['only' => [
    'show'
]]);
Route::resource('agents/{agent}/offers', 'OfferController', ['only' => [
    'show'
]]);
