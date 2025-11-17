# Use PHP + NGINX image
FROM richarvey/nginx-php-fpm:php8.1

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel optimization
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Expose port used by Render
EXPOSE 8080

# Start PHP-FPM
CMD ["php-fpm"]
