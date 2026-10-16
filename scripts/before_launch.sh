#!/bin/bash

# Clear stale caches created during local development
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Run database migrations in production safely
php artisan migrate --force

# Recache for production performance
php artisan config:cache
php artisan route:cache
php artisan view:cache