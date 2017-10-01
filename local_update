#!/usr/bin/env bash

cp -f composer.json composer.json.bak
php local_update.php
composer update
#mv -f composer.json composer.json.new
mv -f composer.json.bak composer.json
#mv -f composer.json.new composer.json.bak
