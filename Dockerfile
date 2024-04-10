FROM bitnami/laravel:latest
COPY . .
COPY .env .
RUN source .env
RUN composer install
RUN php artisan key:generate
EXPOSE 8000
