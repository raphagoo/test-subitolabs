# Use the official PHP image with Apache
FROM php:8.3-apache

# Enable Apache mod_rewrite for Symfony
RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf


# Install system dependencies & PHP extensions needed by Symfony
RUN apt-get update && apt-get install -y \
        libicu-dev \
        git \
        unzip \
    && docker-php-ext-install \
        pdo_mysql \
        intl \
        opcache

# Set the working directory to Apache's document root
WORKDIR /var/www/html

# Copy the application code to the container
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

# Use Composer to install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Adjust file permissions
RUN chown -R www-data:www-data var \
    && chown -R www-data:www-data public
