FROM composer:2.7 as composer

FROM php:8.2.29-fpm-alpine

ARG USER_NAME
ARG USER_ID

USER root

WORKDIR /var/www

#### INSTALL REQUIRE PACKAGE #####

RUN apk update && apk add \
     oniguruma-dev libxml2-dev libpq-dev oniguruma-dev zip

##### ISNTALL COMPOSER #####
COPY --from=composer /usr/bin/composer /usr/local/bin/composer

##### INSTALL PHP EXTENSIONS #####

RUN docker-php-ext-install pdo pdo_pgsql

##### CREATE APP USER #####
RUN addgroup -g ${USER_ID} -S ${USER_NAME} \
    && adduser -u ${USER_ID} -D -S ${USER_NAME} ${USER_NAME}

USER ${USER_NAME}

CMD php-fpm
