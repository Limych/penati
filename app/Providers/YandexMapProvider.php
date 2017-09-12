<?php

namespace Penati\Providers {

    use Illuminate\Support\ServiceProvider;

    class YandexMapProvider extends ServiceProvider
    {
        /**
         * Bootstrap the application services.
         *
         * @return void
         */
        public function boot()
        {
            //
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

        public static function mapUrl($latitude, $longitude, $size = '560x280')
        {
            $size = implode(',', preg_split('/\D+/', $size, -1, PREG_SPLIT_NO_EMPTY));
            $url = "https://static-maps.yandex.ru/1.x/?l=map&ll=$longitude,$latitude&z=17&size=$size" .
                "&pt=$longitude,$latitude,pm2gnm";
            return $url;
        }
    }

}

namespace {

    use Penati\Providers\YandexMapProvider;

    function mapUrl($latitude, $longitude, $size = '560x280')
    {
        return YandexMapProvider::mapUrl($latitude, $longitude, $size);
    }

}