################################################################################
# Base image
################################################################################

FROM php:7-fpm

################################################################################
# Build instructions
################################################################################

RUN apt-get update && apt-get install -y \
    libmcrypt-dev \
    mysql-client \
    && pecl install mcrypt-1.0.1 \
    && docker-php-ext-enable mcrypt \
    && docker-php-ext-install pdo_mysql

# Add app
WORKDIR /var/www
COPY . .
RUN chgrp -R www-data storage bootstrap/cache && chmod -R ug+rwx storage bootstrap/cache

VOLUME /var/www
