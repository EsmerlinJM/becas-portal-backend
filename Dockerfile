ARG PHP_VERSION=7.4
ARG XDEBUG_VERSION=2.9.6

#####################################
##               PHP               ##
#####################################
FROM php:${PHP_VERSION}-fpm AS php

# Install dependencies for the operating system software
RUN apt-get update && apt-get install -y --no-install-recommends \
    build-essential \
    libicu-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    libzip-dev \
    unzip \
    git \
    libonig-dev \
    curl \
    # Clean aptitude cache and tmp directory
    && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install the PHP extensions
RUN docker-php-ext-configure intl \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        pcntl \
        intl \
        opcache \
        pdo_mysql \
        mbstring \
        exif \
        zip \
    && docker-php-ext-enable \
        opcache \
    && docker-php-source delete \
    # Clean aptitude cache and tmp directory
    && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# configure apache document root as per the image documentation in addition rewrite header
ENV APP_HOME /var/www/html
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Use the PORT environment variable in Apache configuration files.
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

RUN a2enmod rewrite headers

#####################################
##              ASSETS             ##
#####################################
FROM php AS assets-builder

WORKDIR /var/www/html
COPY . ./

# Install composer (php package manager)
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN composer global require hirak/prestissimo \
    && composer install \
    && composer global remove hirak/prestissimo

# TODO: TEST environment needs variable setup acordingly
#####################################
##              TEST               ##
#####################################
FROM php AS test

ENV APP_ENV=local
ENV APP_DEBUG=true
ENV LOG_CHANNEL=stack
ENV LOG_LEVEL=debug

COPY --chown=www-data --from=assets-builder /var/www/html /var/www/html
WORKDIR /var/www/html

COPY --from=composer /usr/bin/composer /usr/bin/composer

#####################################
##              PROD               ##
#####################################
FROM php AS prod

ENV APP_ENV=prod
ENV LOG_CHANNEL=stack

COPY --chown=www-data --from=assets-builder /var/www/html /var/www/html
WORKDIR /var/www/html

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN composer global require hirak/prestissimo \
    && composer install \
        --ignore-platform-reqs \
        --no-ansi \
        --no-dev \
        --no-interaction \
    && composer global remove hirak/prestissimo

RUN composer dump-autoload

# Change the group ownership of the storage and bootstrap/cache directories to www-data
# Recursively grant all permissions, including write and execute, to the group
RUN chgrp -R www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R ug+rwx /var/www/html/storage /var/www/html/bootstrap/cache

COPY entrypoint.sh /usr/local/bin/

# start php-fpm server (for FastCGI Process Manager)
ENTRYPOINT ["entrypoint.sh"]
