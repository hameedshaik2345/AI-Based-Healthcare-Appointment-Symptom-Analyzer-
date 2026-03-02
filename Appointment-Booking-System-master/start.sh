#!/bin/bash

# Create SQLite Database if it doesn't exist
touch database/database.sqlite
touch /var/www/html/.env

# Discover packages since composer install was run without scripts
php artisan package:discover --ansi

# Run Laravel migrations and seed database
php artisan migrate --seed --force

# Fix permissions for web server (since migrations run as root)
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/database

# Clear cache and optimize
php artisan optimize:clear

# Start Apache process in the foreground
apache2-foreground
