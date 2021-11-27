FROM php:8.0-fpm-buster

LABEL maintainer="Robson de Jesus"

WORKDIR /var/www/html

RUN apt-get update

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN apt-get update && apt-get install -y \
        libpq-dev \
        libonig-dev \
        libpng-dev \
        zip \
        openssl \
        ca-certificates \
        libzip-dev \
        libgmp-dev \
        libmcrypt-dev \
        curl \
    && apt-get -y clean all \
    && docker-php-ext-install -j$(nproc) pdo \
    && docker-php-ext-install -j$(nproc) pdo_pgsql \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) mbstring \
    && docker-php-ext-install -j$(nproc) opcache \
    && docker-php-ext-install -j$(nproc) zip \
    && docker-php-ext-install -j$(nproc) bcmath \
    && docker-php-ext-install  mbstring
RUN apt-get update \
  && apt-get install vim -y \
  && rm -rf /var/lib/apt/lists/*

RUN apt-get update \
  && apt-get install -y nginx \
  && rm -rf /var/lib/apt/lists/*

RUN rm /etc/nginx/sites-enabled/default
COPY ./docker/nginx.conf /etc/nginx/nginx.conf
RUN rm /var/log/nginx/error.log \
    && rm /var/log/nginx/access.log \
    && ln -s /dev/stdout /var/log/nginx/access.log \
    && ln -s /dev/stderr /var/log/nginx/error.log

RUN mv /usr/local/etc/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/www.conf.backup
COPY ./docker/www.conf /usr/local/etc/php-fpm.d/www.conf
RUN ln -s /dev/stderr /var/log/fpm-php.www.log

COPY ./docker/php.ini $PHP_INI_DIR/php.ini
COPY ./docker/variaveis.ini /usr/local/etc/php/conf.d/variaveis.ini

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type f -exec chmod 644 {} \; \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && chgrp -R www-data storage bootstrap/cache \
    && chmod -R ug+rwx storage bootstrap/cache \
    && usermod -a -G www-data root \
    && chmod -R 777 storage bootstrap/cache

RUN apt-get update \
  && apt-get install -y --no-install-recommends \
    supervisor \
  && rm -rf /var/lib/apt/lists/*

RUN update-ca-certificates && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install
RUN php artisan key:generate

## ENTRYPOINT
COPY ./docker/start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80

# ENTRYPOINT ["/start.sh"]

# Run SUPERVISOR [PID 1]
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
CMD ["/usr/bin/supervisord", "--nodaemon", "--configuration", "/etc/supervisor/conf.d/supervisord.conf"]
