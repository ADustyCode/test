# ==============================
# Base PHP Image (ARM64 SAFE)
# ==============================
FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www

# ==============================
# Install system dependencies
# ==============================
RUN apk update && apk add --no-cache \
    bash \
    curl \
    git \
    unzip \
    zip \
    icu-dev \
    libpng-dev \
    libzip-dev \
    oniguruma-dev \
    mysql-client

# ==============================
# Install PHP Extensions
# ==============================
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    bcmath \
    gd \
    zip \
    intl

# ==============================
# Install Composer (ARM64 OK)
# ==============================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ==============================
# Copy Laravel Source
# ==============================
COPY . .

# ==============================
# Install Laravel dependencies
# (safe for low CPU)
# ==============================
RUN composer install \
    --no-dev \
    --no-interaction \
    --optimize-autoloader || true

# ==============================
# Permissions
# ==============================
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

# ==============================
# Expose PHP-FPM Port
# ==============================
EXPOSE 9000

CMD ["php-fpm"]