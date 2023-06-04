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
    ffmpeg

#install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/*


RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg

#install php required extensions
RUN docker-php-ext-install pdo_mysql pdo mbstring exif pcntl bcmath gd zip sockets

#enable installed extensions
RUN docker-php-ext-enable pdo_mysql pdo mbstring exif pcntl bcmath gd zip  sockets

EXPOSE 9000

ENV DOCKER_HOST_USER_ID=1000

ENV DOCKER_HOST_GROUP_ID=1000

RUN groupadd -g $DOCKER_HOST_GROUP_ID www

RUN useradd -u $DOCKER_HOST_USER_ID -ms /bin/bash -g www www

USER www

CMD  php-fpm
