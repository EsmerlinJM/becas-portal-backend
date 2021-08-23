#!/bin/sh
set -e

php artisan migrate:refresh
php artisan passport:install
php artisan db:seed
apache2-foreground
# php-fpm
