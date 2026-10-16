FROM richarvey/nginx-php-fpm:latest

# Copy application files (including vendor)
COPY . /var/www/html

# Ensure web server user owns storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Webroot configuration
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV REAL_IP_HEADER 1

EXPOSE 80