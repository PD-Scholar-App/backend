FROM bitnami/laravel:latest
COPY . .
RUN composer install
EXPOSE 8000
ENV DB_CONNECTION=mysql
ENV DB_HOST=127.0.0.1
ENV DB_PORT=3306
ENV DB_DATABASE=scholar-db
ENV DB_USERNAME=root
ENV DB_PASSWORD=
COPY .env .
RUN source .env
