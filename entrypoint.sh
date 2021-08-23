#!/bin/sh
set -e

if [ -z "$FRESH_INSTALL" ]; then
    echo "The variable \$FRESH_INSTALL is empty, using default init"
    php artisan migrate
else
    php artisan migrate:refresh
    php artisan passport:install --force
    php artisan db:seed
fi

apache2-foreground
# php-fpm
