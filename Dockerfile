# 1️⃣ Node.js build stage
FROM node:18 AS node-build

WORKDIR /app
COPY package*.json ./
RUN rm -rf package-lock.json node_modules
RUN npm_config_ignore_optional=true npm install

COPY . .
RUN npm run build

# 2️⃣ PHP runtime stage
FROM php:8.2-fpm

# Install system dependencies (no need for Node.js in final PHP image)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Copy built assets from Node.js stage
COPY --from=node-build /app/public /var/www/public
COPY --from=node-build /app/node_modules /var/www/node_modules

# Set file permissions
RUN chown -R www-data:www-data /var/www
RUN chmod -R 777 /var/www/storage

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Generate Laravel app key
RUN php artisan key:generate
