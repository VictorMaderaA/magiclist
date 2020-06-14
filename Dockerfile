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


# # Build frontend assets
# FROM node as frontend
# WORKDIR /app

# COPY package.json package-lock.json webpack.mix.js /app/
# RUN npm install

# COPY resources /app/resources
# RUN mkdir /app/public \
#     /app/public/css \
#     /app/public/js \ 
#     /app/public/mix
# RUN npm run production


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
    unzip

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
COPY --from=backend /app /var/www
# COPY --from=frontend /app/public /var/www/public
RUN chgrp -R www-data /var/www/storage /var/www/bootstrap/cache && chmod -R ug+rwx /var/www/storage /var/www/bootstrap/cache
RUN chown -R www-data:www-data /var/www
RUN chmod +x /var/www/docker-compose/script/cron.sh

# RUN php artisan key:generate
RUN php artisan optimize
RUN php artisan config:clear

