#
# PHP Dependencies
#
FROM composer:latest as vendor

COPY database/ database/

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

##
## Frontend
##
#FROM node:latest as frontend
#
#RUN mkdir -p /app/public
#
#COPY . /app
#
#WORKDIR /app
#RUN npm -v
#RUN npm i -f && npm production


#
# Application
#
FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    npm \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

COPY . /var/www/
COPY --from=vendor /app/vendor /var/www/vendor
#COPY --from=frontend /app/public/js/ /var/www/public/js/
#COPY --from=frontend /app/public/css/ /var/www/public/css/
#COPY --from=frontend /app/public/mix/ /var/www/public/css/
#COPY --from=frontend /app/mix-manifest.json /var/www/mix-manifest.json
RUN npm install && npm run prod

USER $user
