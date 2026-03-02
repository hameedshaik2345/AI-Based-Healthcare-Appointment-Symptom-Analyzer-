#!/bin/bash

# Create a proper .env file using example as base
cp .env.example .env
echo "" >> .env
echo "APP_KEY=${APP_KEY}" >> .env
echo "APP_ENV=production" >> .env
echo "APP_DEBUG=true" >> .env
echo "DB_CONNECTION=sqlite" >> .env
echo "LOG_CHANNEL=stderr" >> .env

# Create SQLite Database if it doesn't exist
touch database/database.sqlite

# Discover packages since composer install was run without scripts
php artisan package:discover --ansi

# Run Laravel migrations and seed database
php artisan migrate --seed --force

# Fix permissions for web server (since migrations run as root)
chown -R www-data:www-data /var/www/html
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Clear cache and optimize
php artisan optimize:clear

# Start Apache process in the foreground
apache2-foreground
