# syntax=docker/dockerfile:1.4

FROM php:8.1-fpm

ARG WORK_DIR
ARG DB_CONNECTION
ARG DB_HOST
ARG DB_PORT
ARG DB_DATABASE
ARG DB_USERNAME
ARG DB_PASSWORD

RUN apt-get update && apt-get install -y \
    build-essential \
    curl git cron tar less zip unzip \
    jpegoptim optipng pngquant gifsicle \
    locales \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libonig-dev \
    libmcrypt-dev \
    vim bash mc

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install bcmath exif mbstring mysqli pdo pdo_mysql

RUN pecl install apcu-5.1.21 mcrypt

RUN docker-php-ext-enable apcu opcache mcrypt

RUN rm -rf /tmp/pear

COPY --from=composer:2.1 /usr/bin/composer /usr/local/bin/composer

# standard composer vendor/bin location ~/.config/composer/vendor/bin
ENV PATH="${PATH}:/root/.composer/vendor/bin"

COPY ./php-fpm/crontab /etc/cron.d/crontab
RUN touch /var/log/cron.log
RUN chmod 0644 /etc/cron.d/crontab \
    && crontab /etc/cron.d/crontab

COPY ./php-fpm/docker-entrypoint.sh /

COPY <<EOF /etc/laravel-app.env
WORK_DIR=${WORK_DIR}

APP_URL=http://localhost:8000
APP_DEBUG=true
APP_KEY=
APP_NAME=Laravel
APP_ENV=local

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=${DB_CONNECTION}
DB_HOST=${DB_HOST}
DB_PORT=${DB_PORT}
DB_DATABASE=${DB_DATABASE}
DB_USERNAME=${DB_USERNAME}
DB_PASSWORD=${DB_PASSWORD}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

EOF

WORKDIR ${WORK_DIR}

#COPY ./src .

ENTRYPOINT ["/docker-entrypoint.sh"]

CMD bash -c "cron && php-fpm"