FROM php:7.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    unzip \
    zip \
    git \
    libzip-dev \
    zlib1g-dev \
    && docker-php-ext-install mysqli zip

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy and install PHP dependencies
COPY composer.json composer.lock ./
RUN composer install

# Copy application code
COPY . .

# Set correct permissions (optional)
RUN chown -R www-data:www-data /var/www/html
