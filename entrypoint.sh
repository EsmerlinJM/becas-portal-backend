#!/bin/sh
set -e

if [ -z "$FRESH_INSTALL" ]; then
    echo "The variable \$FRESH_INSTALL is empty, using default init"
    php artisan migrate
    php artisan passport:install
else
    php artisan migrate:refresh
    php artisan db:seed
    php artisan passport:install --force
fi

apache2-foreground
# php-fpm
