# Build backend source
FROM composer as backend
WORKDIR /app

COPY composer.json composer.lock /app/
RUN composer install  \
    --ignore-platform-reqs \
    --no-ansi \
    --no-autoloader \
    --no-dev \
    --no-interaction \
    --no-scripts

COPY . /app/
RUN composer dump-autoload --optimize --classmap-authoritative


# Build frontend assets
FROM node as frontend
WORKDIR /app

COPY package.json package-lock.json webpack.mix.js /app/
RUN npm install

COPY resources /app/resources
RUN mkdir /app/public \
    /app/public/css \
    /app/public/js \
    /app/public/mix
RUN npm run production


#
# Application
#
FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get upgrade -y && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    php-redis \
    redis-server

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www
COPY . /var/www/
COPY --from=backend /app /var/www/
COPY --from=frontend /app/public /var/www/public/
RUN chown -R $user:www-data . && usermod -a -G www-data $user && find . -type f -exec chmod 644 {} \; &&  find . -type d -exec chmod 755 {} \;
RUN chgrp -R www-data storage bootstrap/cache && chmod -R ug+rwx storage bootstrap/cache

# RUN php artisan key:generate
RUN php artisan optimize && php artisan config:clear && php artisan config:cache

