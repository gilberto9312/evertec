FROM php:7.3-apache

ARG UID
ARG APP_XDEBUG_HOST
ARG APP_XDEBUG_PORT=9000

RUN adduser -u ${UID} --disabled-password --gecos "" appuser || echo "User already exists."

RUN apt-get update && apt-get install -y unzip git \
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/*

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
RUN install-php-extensions pdo_mysql xdebug gd pgsql pdo_pgsql

RUN ln -s $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request = yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=${APP_XDEBUG_PORT}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=${APP_XDEBUG_HOST}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY docker/000-default.conf /etc/apache2/sites-enabled/000-default.conf
COPY docker/app.conf /etc/apache2/conf-enabled/z-app.conf
COPY docker/app.ini $PHP_INI_DIR/conf.d/app.ini

COPY --from=composer:1.10 /usr/bin/composer /usr/bin/composer

RUN a2enmod headers rewrite

USER $UID

WORKDIR /var/www/app
