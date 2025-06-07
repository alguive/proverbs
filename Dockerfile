FROM php:8.3-fpm-alpine

# RUN composer self-update -- not attached to any version - shall we?
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# System Dependencies
RUN apk add --no-cache \
    nodejs npm curl wget libzip-dev  \
    postgresql-dev icu-dev bash git  \
    autoconf linux-headers g++ make  \
    rabbitmq-c-dev libzip-dev \
    libpng-dev libjpeg-turbo-dev freetype-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# PHP Extensions
RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql intl gd zip # Leaving mysql & pgsql - pending on define which one do we use

RUN pecl install amqp redis  \
    && docker-php-ext-enable amqp redis

RUN mkdir -p /var/log \
	&& mkdir -p /var/www/html/var \
	&& mkdir -p /var/www/html/public
#    && touch /var/log/xdebug.log \
#    && chmod 777 /var/log/xdebug.log

WORKDIR /var/www/html

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/var /var/www/html/public

COPY /docker/entrypoint.sh /etc/entrypoint.sh

RUN chmod +x /etc/entrypoint.sh

ENTRYPOINT ["/etc/entrypoint.sh"]

EXPOSE 9000

CMD ["php-fpm"]
