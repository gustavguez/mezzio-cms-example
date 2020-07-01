FROM php:7.3-apache

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN apt-get update \
    && apt-get install -y zip libzip-dev git \
    && docker-php-ext-configure zip --with-libzip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install pdo_mysql mysqli \
    && a2enmod rewrite \
    && sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf \
    && mv /var/www/html /var/www/public \
    && curl -sS https://getcomposer.org/installer \
        | php -- --install-dir=/usr/local/bin --filename=composer \
    && echo "AllowEncodedSlashes On" >> /etc/apache2/apache2.conf

RUN usermod -u 1000 www-data

WORKDIR /var/www
