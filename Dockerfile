FROM richarvey/nginx-php-fpm:8.2.0

WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html

# Install dos2unix to strip Windows CRLF line endings from bash scripts
RUN apk add --no-cache dos2unix && \
    if [ -f /var/www/html/scripts/before_launch.sh ]; then \
        dos2unix /var/www/html/scripts/before_launch.sh && \
        chmod +x /var/www/html/scripts/before_launch.sh; \
    fi

# Install dependencies inside the PHP 8.2 container
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set storage and cache permissions for www-data
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Set Environment Variables
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV REAL_IP_HEADER 1
ENV RUN_SCRIPTS 1

EXPOSE 80