FROM php:7.1-cli

ARG GITHUB_TOKEN

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer config -g github-oauth.github.com $GITHUB_TOKEN

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git


#install some base extensions
RUN apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-install zip
WORKDIR /var/www/html
