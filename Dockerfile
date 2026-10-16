# Stage 1: Build dependencies using official Composer image (has higher RAM limits)
FROM composer:2 AS vendor-builder

WORKDIR /app

# Copy dependency definition files
COPY composer.json composer.lock ./

# Install dependencies without dev packages
RUN composer install --no-dev --no-interaction --prefer-dist --ignore-platform-reqs

# Stage 2: Production web server
FROM richarvey/nginx-php-fpm:latest

WORKDIR /var/www/html

# Copy application source code
COPY . /var/www/html

# Copy vendor directory built in Stage 1
COPY --from=vendor-builder /app/vendor /var/www/html/vendor

# Fix script line endings if startup script exists
RUN apk add --no-cache dos2unix && \
    if [ -f /var/www/html/scripts/before_launch.sh ]; then \
        dos2unix /var/www/html/scripts/before_launch.sh && \
        chmod +x /var/www/html/scripts/before_launch.sh; \
    fi

# Set permissions for web server
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/vendor && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Web server environment variables
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV REAL_IP_HEADER 1
ENV RUN_SCRIPTS 1

EXPOSE 80