FROM richarvey/nginx-php-fpm:latest

# Copy project files
COPY . /var/www/html

# Configure image environment
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Tell richarvey image to run composer install automatically when container boots
ENV COMPOSER_INSTALL_ON_START 1

EXPOSE 80