FROM richarvey/nginx-php-fpm:latest

# Copy project files including vendor
COPY . /var/www/html

# Set webroot
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV REAL_IP_HEADER 1

EXPOSE 80