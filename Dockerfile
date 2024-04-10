FROM bitnami/laravel:latest
COPY . .
RUN composer install
RUN php artisan key:generate
EXPOSE 8000
