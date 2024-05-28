FROM php:8.1-apache

WORKDIR /var/www/app

RUN apt-get update \
    && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && apt-get install -y php-mysql \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
COPY . .

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public/"]