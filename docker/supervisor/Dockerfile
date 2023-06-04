FROM php:8.2-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    libwebp-dev \
    git \
    curl \
    build-essential \
    libzip-dev \
    libpng-dev libxpm-dev \
    libonig-dev \
    libmcrypt-dev \
    libgd-dev \libjpeg62-turbo-dev \
    libfreetype6-dev \
    jpegoptim optipng pngquant gifsicle \
    locales \
    libxml2-dev \
    zip \
    unzip \
    net-tools \
    nano \
    supervisor \
    telnetd \
    iputils-ping \
    tcpdump

RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg

RUN pecl install redis
#install php required extensions
RUN docker-php-ext-install pdo_mysql pdo mbstring exif pcntl bcmath gd zip sockets

#enable installed extensions
RUN docker-php-ext-enable pdo_mysql pdo mbstring exif pcntl bcmath gd zip  sockets redis

CMD ["/usr/bin/supervisord","-c", "/etc/supervisor/custom/supervisord.conf"]
