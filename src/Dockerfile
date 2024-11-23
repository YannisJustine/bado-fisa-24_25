# Use an official PHP image with Apache as the base image.
FROM php:8.2-apache

ENV ACCEPT_EULA=Y

RUN apt-get update && apt-get install -y \
    libpq-dev \
    nodejs npm \
    supervisor \
    unzip \
    zip \
    vim \
    && rm -rf /var/lib/apt/lists/* \
    && a2enmod rewrite 

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

RUN docker-php-ext-install pdo pdo_pgsql \
    && docker-php-ext-enable pdo pdo_pgsql

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
RUN mkdir -p /var/log/supervisor

RUN pecl install --force redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-interaction --optimize-autoloader && \
    chown -R www-data:www-data ./storage ./bootstrap/cache && \
    make install && make build

RUN php artisan key:generate
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

EXPOSE 80

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/supervisord.conf"]