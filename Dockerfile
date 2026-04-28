FROM php:8.2-cli

# 1. Install system dependencies for Laravel
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath

# 2. Get the Composer installation tool
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Set the working directory inside the server
WORKDIR /var/www

# 4. Copy all your Laravel files into the server
COPY . .

# 5. Install Laravel's dependencies
RUN composer install --optimize-autoloader --no-dev

# 6. Fix folder permissions so Laravel doesn't crash
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# 7. The Start Command (Migrate database and turn on server)
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT