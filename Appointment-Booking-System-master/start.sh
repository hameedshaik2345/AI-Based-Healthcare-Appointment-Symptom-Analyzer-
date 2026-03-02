#!/bin/bash
# Create SQLite Database if it doesn't exist
touch database/database.sqlite

# Run Laravel migrations and seed database
php artisan migrate --seed --force

# Start Apache process in the foreground
apache2-foreground
