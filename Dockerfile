# Stage 1: Build PHP and Apache
FROM php:8.2-apache AS builder
RUN apt-get update
RUN apt-get install -y --no-cache libzip-dev zip
RUN docker-php-ext-install pdo_mysql zip
RUN a2enmod rewrite

# Copy pre-configured Apache configuration
COPY httpd.conf /etc/apache2/apache2.conf

# Stage 2: Copy application code
FROM builder AS app
ENV APP_DIR=/var/www/html/public
COPY . /var/www/html
WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

# Default user: www-data
RUN chown -R www-data:www-data $APP_DIR /var/www/html/storage /var/www/html/bootstrap/cache
