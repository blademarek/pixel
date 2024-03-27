FROM php:8.1.14-fpm

ARG user
ARG uid

# INIT

ENV BUILD_DEPS libc-client-dev libicu-dev git libzip-dev zlib1g-dev libkrb5-dev libpng-dev g++ build-essential libssl-dev libsasl2-dev libmagickwand-dev libonig-dev

ENV RUN_DEPS git wget vim curl less gnupg unzip pv

# INSTALL DEPENDENCIES

RUN apt-get update && apt-get install -y ${BUILD_DEPS} ${RUN_DEPS} --no-install-recommends \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install -j$(nproc) mysqli pdo_mysql bcmath iconv zip intl imap gd soap sockets

RUN useradd -G www-data,root -u $uid -d /home/$user $user

# XDEBUG

RUN pecl install xdebug && docker-php-ext-enable xdebug

ADD xdebug.ini /tmp/xdebug.ini

RUN cat /tmp/xdebug.ini >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

ADD log.conf /usr/local/etc/php-fpm.d/zz-log.conf

# COMPOSER

RUN mkdir -p /composer && mkdir -p /composer/bin

ENV COMPOSER_HOME /composer

ENV PATH /composer/bin:/composer/vendor/bin:$PATH

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/composer/bin --filename=composer

# NANO

RUN apt-get update && apt-get install -y nano

# CUSTOM BASH PROFILE

RUN echo "alias ll='ls -alG'" >> /etc/bash.bashrc
RUN echo "alias ls='ls --color=auto'" >> /etc/bash.bashrc
RUN echo "alias ..='cd ..'" >> /etc/bash.bashrc