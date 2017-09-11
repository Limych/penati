#!/bin/sh

if [ ! -f ./composer.phar ]; then
    ./composer-install.sh
fi
php composer install
php artisan storage:link
php artisan install