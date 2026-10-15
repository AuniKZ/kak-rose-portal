FROM richarvey/nginx-php-fpm:latest

# Copy project files
COPY . /var/www/html

# Set Laravel public folder as webroot
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Automatically run database migrations on boot
ENV CMD="php artisan migrate --force"

# Expose HTTP port
EXPOSE 80