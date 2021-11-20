#!/bin/sh
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan get:statistics