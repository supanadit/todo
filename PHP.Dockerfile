FROM php:7.4-fpm

RUN apt-get update

RUN apt-get install -y git zip

RUN docker-php-ext-install pdo pdo_mysql

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer