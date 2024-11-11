# Use the official PHP image as a base image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 9000 and start PHP-FPM server
EXPOSE 9000
CMD ["php-fpm"]
