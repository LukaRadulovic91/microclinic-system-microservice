# Use official PHP image with needed extensions
FROM php:8.2-fpm

# Arguments for user & group (optional)
ARG UID=1000
ARG GID=1000

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    libonig-dev \
    libxml2-dev \
    supervisor \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip xml

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

# Copy and run composer install
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
