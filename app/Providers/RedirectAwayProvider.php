<?php

namespace Penati\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Redirect;

class RedirectAwayProvider extends ServiceProvider
{
    const ROUTE = 'away';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::get(static::ROUTE.'/{url}', function ($url) {
            return Redirect::away($url);
        })->where('url', '.+');

        Blade::directive('away', function ($url) {
            return url(static::ROUTE.'/'.rawurlencode($url));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
