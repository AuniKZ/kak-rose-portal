FROM richarvey/nginx-php-fpm:latest

# Copy project files into container
COPY . /var/www/html

# Change working directory
WORKDIR /var/www/html

# Install Composer packages directly during image build
RUN composer install --no-dev --optimize-autoloader

# Set image environment variables
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Expose HTTP port
EXPOSE 80