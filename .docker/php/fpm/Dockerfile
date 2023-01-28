FROM php:8.2-fpm-alpine

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH=$HOME/.composer/vendor/bin:$PATH

# Download script to install PHP extensions and dependencies
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod uga+x /usr/local/bin/install-php-extensions && sync

# install system utilities
RUN apk add --no-cache \
    curl \
    nano \
    bash \
    zip unzip \
    git \
    netcat-openbsd \
    ca-certificates \
    linux-headers \
    openssh \
    nodejs npm

# Install PHP
RUN install-php-extensions \
    bcmath \
    bz2 \
    pcntl \
    calendar \
    exif \
    gd \
    intl \
    imagick \
    ssh2 \
    opcache \
    redis \
    soap \
    xsl \
    gmp \
    zip \
    sockets \
    pdo_mysql \
    mysqli \
    xdebug-stable \
    amqp-stable \
    @composer

# Install symfony cli
RUN curl -LsS https://get.symfony.com/cli/installer -o /usr/local/bin/symfony \
 && chmod a+x /usr/local/bin/symfony

# Configure PHP
COPY conf/conf.d/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY conf/conf.d/docker-php-ext-opcache.ini /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini
COPY conf/php.development.ini /usr/local/etc/php/php.ini

WORKDIR /var/www/html

ENTRYPOINT ["php-fpm", "-R"]
