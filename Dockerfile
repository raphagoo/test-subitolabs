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
        zip \
    && docker-php-ext-install \
        pdo_mysql \
        intl \
        opcache

# Set the working directory to Apache's document root
WORKDIR /var/www/html

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_MEMORY_LIMIT -1
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV PATH="${PATH}:/root/.composer/vendor/bin"

