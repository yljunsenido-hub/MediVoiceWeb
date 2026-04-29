FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql zip

WORKDIR /var/www/html

COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && php composer.phar install --no-dev --optimize-autoloader

# Fix Laravel public folder for Apache
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Enable rewrite (IMPORTANT for Laravel routes)
RUN a2enmod rewrite

# Permissions fix
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# 🔥 IMPORTANT: Render port fix
ENV PORT=10000

# Tell Apache to listen to Render port
RUN sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf
RUN sed -i "s/80/${PORT}/g" /etc/apache2/sites-available/000-default.conf

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install JS dependencies
RUN npm install

# Build Vite assets
RUN npm run build

EXPOSE 10000



CMD ["apache2-foreground"]