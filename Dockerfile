FROM php:8.2-fpm

# ==============================================================================
# 1. INSTALL SYSTEM DEPENDENCIES & EXTENSIONS
# ==============================================================================
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    nginx \
    supervisor \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions yang dibutuhkan oleh Laravel & PostgreSQL
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd pdo_pgsql

# Install Composer terbaru
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ==============================================================================
# 2. CONFIGURATION & WORKING DIRECTORY
# ==============================================================================
WORKDIR /var/www/html

# Menyalin seluruh file project
COPY . /var/www/html

# Install dependencies Laravel lewat Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Mengatur permissions folder storage dan cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# ==============================================================================
# 3. NGINX CONFIGURATION (MENGGUNAKAN UNIX SOCKET DEFAULT PHP-FPM)
# ==============================================================================
RUN rm -f /etc/nginx/sites-enabled/default /etc/nginx/sites-available/default

# Kita arahkan fastcgi_pass langsung ke socket php-fpm bawaan docker image (/var/run/php-fpm.sock)
RUN echo 'server { \
    listen 80; \
    server_name _; \
    root /var/www/html/public; \
    index index.php index.html; \
    charset utf-8; \
    location / { \
        try_files $uri $uri/ /index.php?$query_string; \
    } \
    location ~ \.php$ { \
        fastcgi_pass unix:/var/run/php-fpm.sock; \
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; \
        include fastcgi_params; \
    } \
    location ~ /\.(?!well-known).* { \
        deny all; \
    } \
}' > /etc/nginx/sites-enabled/default

# Paksa konfigurasi global PHP-FPM untuk membuat file socket tersebut
RUN sed -i 's|listen = 127.0.0.1:9000|listen = /var/run/php-fpm.sock|g' /usr/local/etc/php-fpm.d/www.conf || true
RUN echo "listen.owner = www-data\nlisten.group = www-data\nlisten.mode = 0660" >> /usr/local/etc/php-fpm.d/www.conf

# ==============================================================================
# 4. SUPERVISOR CONFIGURATION
# ==============================================================================
RUN echo '[supervisord] \n\
nodaemon=true \n\
user=root \n\
\n\
[program:php-fpm] \n\
command=php-fpm \n\
autostart=true \n\
autorestart=true \n\
stdout_logfile=/dev/stdout \n\
stdout_logfile_maxbytes=0 \n\
stderr_logfile=/dev/stderr \n\
stderr_logfile_maxbytes=0 \n\
\n\
[program:nginx] \n\
command=nginx -g "daemon off;" \n\
autostart=true \n\
autorestart=true \n\
stdout_logfile=/dev/stdout \n\
stdout_logfile_maxbytes=0 \n\
stderr_logfile=/dev/stderr \n\
stderr_logfile_maxbytes=0' > /etc/supervisor/conf.d/laravel.conf

# ==============================================================================
# 5. ENTRYPOINT COMMAND
# ==============================================================================
CMD sh -c "sed -i 's/listen 80;/listen '\${PORT}';/g' /etc/nginx/sites-enabled/default && exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf"