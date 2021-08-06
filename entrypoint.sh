#!/bin/sh
set -e

php artisan migrate
php-fpm
