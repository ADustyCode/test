#!/bin/sh
set -e

# Run migrations if DB is ready
php artisan migrate --force

# Cache configuration and routes for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start PHP-FPM
exec php-fpm
