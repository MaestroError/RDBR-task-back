#!/bin/sh
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
echo "installation complated successfully, you can run `php artisan serve`"