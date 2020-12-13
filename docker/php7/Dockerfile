FROM php:7.4-fpm

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer


RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev \
        unzip \
		zip
        

RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN apt-get install -y git
