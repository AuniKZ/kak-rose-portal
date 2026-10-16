#!/bin/bash

# Clear stale caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Run database migrations
php artisan migrate --force