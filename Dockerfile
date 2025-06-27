FROM php:8.2-fpm

# Install Nginx, supervisor, dan ekstensi PHP (opsional: mysqli, dll)
RUN apt-get update && apt-get install -y nginx supervisor \
    && docker-php-ext-install mysqli

# Copy konfigurasi Nginx
COPY .docker/nginx.conf /etc/nginx/nginx.conf

# Copy konfigurasi supervisor
COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy seluruh project ke dalam container
COPY . /var/www/html

# Set permission
RUN chown -R www-data:www-data /var/www/html

# Jalankan nginx dan php-fpm via supervisord
CMD ["/usr/bin/supervisord"]
