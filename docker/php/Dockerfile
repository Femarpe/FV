FROM php:8.2.27-fpm-alpine3.20

# Instala dependencias necesarias para compilar extensiones
RUN apk --no-cache add \
    linux-headers \
    autoconf \
    g++ \
    make \
    git \
    libzip-dev \
    freetype-dev \
    libtool \
    libxml2-dev \
    zip \
    bash \
    oniguruma-dev \
    icu-dev \
    zlib-dev \
    composer \
    php-ctype php-xml php-tokenizer php-session php-dom php-simplexml

# Instala y habilita extensiones
RUN docker-php-ext-install pdo pdo_mysql simplexml zip ctype xml session dom simplexml

# Instala Xdebug (opcional para desarrollo)
RUN pecl install xdebug-3.3.2 && docker-php-ext-enable xdebug

# Asigna permisos de usuario
RUN adduser -S 1000 -u 1000 && chown -R 1000:1000 /home/1000

# Ajusta php.ini y copia config por defecto
RUN sed -i 's/memory_limit = 128M/memory_limit = 512M/' /usr/local/etc/php/php.ini-development && \
    sed -i 's/memory_limit = 128M/memory_limit = 512M/' /usr/local/etc/php/php.ini-production && \
    cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
