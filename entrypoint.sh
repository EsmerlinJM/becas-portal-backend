#!/bin/sh
set -e

php artisan migrate
# php artisan passport:install
# php artisan passport:client --personal
# php artisan db:seed
apache2-foreground
# php-fpm
