FROM richarvey/nginx-php-fpm:8.2.0

WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html

# Set Webroot & Environment
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV REAL_IP_HEADER 1
ENV RUN_SCRIPTS 1

# Ensure executable permissions for startup script & web storage
RUN chmod +x /var/www/html/scripts/before_launch.sh \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80