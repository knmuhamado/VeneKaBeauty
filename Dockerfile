FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html
COPY . .

RUN mkdir -p storage/app/google

RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 777 storage bootstrap/cache

RUN a2enmod rewrite

EXPOSE 80

CMD sh -c "echo 'APP_NAME=${APP_NAME}' > .env && \
           echo 'APP_ENV=${APP_ENV}' >> .env && \
           echo 'APP_DEBUG=${APP_DEBUG}' >> .env && \
           echo 'APP_KEY=${APP_KEY}' >> .env && \
           echo 'DB_CONNECTION=${DB_CONNECTION}' >> .env && \
           echo 'DB_HOST=${DB_HOST}' >> .env && \
           echo 'DB_PORT=${DB_PORT}' >> .env && \
           echo 'DB_DATABASE=${DB_DATABASE}' >> .env && \
           echo 'DB_USERNAME=${DB_USERNAME}' >> .env && \
           echo 'DB_PASSWORD=${DB_PASSWORD}' >> .env && \
           php artisan key:generate --force && \
           php artisan migrate --force && \
           apache2-foreground"
