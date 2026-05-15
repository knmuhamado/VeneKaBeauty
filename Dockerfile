FROM php:8.2-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    nodejs npm \
    && docker-php-ext-install pdo_mysql zip mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copiar el proyecto
WORKDIR /var/www/html
COPY . .

# Crear directorio para credenciales de Google
RUN mkdir -p storage/app/google

# Instalar dependencias de GCS
RUN composer require league/flysystem-google-cloud-storage --with-all-dependencies
RUN composer update --no-dev --optimize-autoloader

# Instalar dependencias Node y compilar Vite
RUN npm install && npm run build

# Permisos
RUN chmod -R 777 storage bootstrap/cache

# Activar mod_rewrite
RUN a2enmod rewrite

EXPOSE 80

# Comando de inicio
CMD sh -c "php artisan storage:link && apache2-foreground"
