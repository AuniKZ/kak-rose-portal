FROM richarvey/nginx-php-fpm:latest

# Copy application files
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install required system dependencies (unzip) then run composer
RUN apt-get update && apt-get install -y unzip && \
    composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# Configure web server settings
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

EXPOSE 80