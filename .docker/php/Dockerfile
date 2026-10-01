FROM composer@sha256:af98f42dfff7c68ba8d53c2164fd9fde1087b7d449514baa38c418b1f6bc4bac
FROM php:8.1-fpm-alpine@sha256:b97400fc10fa4f9d3e015c92dd1498808f7bb114ca26fc5ed831f6bf37bf309d

ARG USER_ID=1000
ARG WITH_XDEBUG=false
ARG GITHUB_TOKEN

COPY --from=composer@sha256:af98f42dfff7c68ba8d53c2164fd9fde1087b7d449514baa38c418b1f6bc4bac /usr/bin/composer /usr/local/bin/composer

RUN apk update && \
    apk add --no-cache ca-certificates git shadow bash && \
    apk add --no-cache --virtual .build-deps $PHPIZE_DEPS icu-dev && \
    docker-php-ext-enable opcache

RUN if [ ${WITH_XDEBUG} = true ]; then \
    pecl install xdebug && docker-php-ext-enable xdebug \
;fi

RUN apk del .build-deps

WORKDIR .
ADD . .

RUN usermod -u $USER_ID www-data && chown -R www-data:www-data /var/www/ .

USER www-data
RUN composer config -g github-oauth.github.com $GITHUB_TOKEN

CMD ["php-fpm"]
