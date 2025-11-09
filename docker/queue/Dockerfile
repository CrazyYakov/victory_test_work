FROM php:8.2-alpine

USER root

#### INSTALL REQUIRE PACKAGE #####

RUN apk update && apk add \
     oniguruma-dev libxml2-dev libpq-dev oniguruma-dev zip

##### INSTALL PHP EXTENSIONS #####

RUN docker-php-ext-install pdo pdo_pgsql

WORKDIR /var/www

ENTRYPOINT ["php", "artisan", "queue:work", "--tries=1", "--timeout=30", "--queue=default", "--sleep=5"]
