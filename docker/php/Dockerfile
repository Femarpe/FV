FROM php:8.2.27-fpm-alpine3.20

RUN apk --update --no-cache add linux-headers autoconf g++ make git openssh-client libressl-dev libzip-dev freetype-dev libtool
RUN pecl install xdebug-3.3.2 zip && docker-php-ext-enable xdebug
RUN docker-php-ext-install mysqli pdo pdo_mysql zip && docker-php-ext-enable mysqli

RUN adduser -S 1000 -u 1000 && chown -R 1000:1000 /home/1000