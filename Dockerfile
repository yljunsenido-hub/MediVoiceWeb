FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql zip

COPY . /var/www/html

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php \
    && php composer.phar install --no-dev --optimize-autoloader

# 👇 ADD THIS LINE HERE
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

RUN a2enmod rewrite

EXPOSE 80