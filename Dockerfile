FROM richarvey/nginx-php-fpm:latest

# Copy application files
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Run composer using the image's built-in binaries
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# Configure web server settings
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

EXPOSE 80