#!/bin/sh
set -e

if [ -z "$FRESH_INSTALL" ]; then
    echo "The variable \$FRESH_INSTALL is empty, using default init"
    php artisan migrate -n --force
else
    php artisan migrate:refresh -n --force
    php artisan db:seed -n --force
    php artisan passport:install --force
fi

apache2-foreground
# php-fpm
