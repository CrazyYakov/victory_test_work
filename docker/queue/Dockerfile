FROM php:8.2-alpine

USER root

RUN apk update; \
    docker-php-ext-install zip; \

EXPOSE 8080 8081
WORKDIR /var/www

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
