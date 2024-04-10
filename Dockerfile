FROM bitnami/laravel:latest
COPY . .
RUN composer install
RUN php artisan key:generate
RUN php artisan migrate
EXPOSE 8000
