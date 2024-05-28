FROM php:8.3.3-fpm-alpine3.19

# Install dependencies
RUN apk add --update \
    libxml2-dev libzip-dev libpng-dev libxpm-dev libvpx-dev libc-dev \
    openssl-dev imap autoconf gcc build-base postgresql-dev \
    curl busybox-extras rsync tree linux-headers tzdata \
    && apk add git vim curl zip openssl ffmpeg bash imap-dev krb5-dev mc

# Install & Configure PHP extensions
RUN docker-php-ext-install -j$(nproc) gd zip pdo pdo_mysql pdo_pgsql pgsql opcache intl bcmath

RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install imap \
    && docker-php-ext-enable imap

RUN docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install pcntl

# Timezonedb extension
RUN pecl install timezonedb \
    && pecl upgrade timezonedb \
    && docker-php-ext-enable timezonedb

# Clear tmp files
RUN docker-php-source delete \
    && rm -rf /tmp/pear \
    && rm -rf /var/cache/apk/*

# Configure opcache
COPY .development/docker/php/opcache.ini /usr/local/etc/php/conf.d/

# Configure fpm
COPY .development/docker/php/www.conf /usr/local/etc/php-fpm.d/

# Install composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-setup.php

# Create app directory
RUN mkdir /app

# Set working directory
WORKDIR /app

# Copy composer files
COPY ./composer.json .
COPY ./composer.lock .

# Install composer dependencies
RUN composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist \
    --no-dev

RUN chown -R www-data:www-data /app

