FROM composer@sha256:8209324ed15c43af0c5cc900cbb9fd01e94b84a94c4bb0969aa95d31d2d7e43d
FROM php:8.5-fpm-alpine@sha256:22a4c414bb8e91ac7aefe9b1d80e832caa67252aca58b6af7eeb3bc92188fc5b

ARG USER_ID=1000
ARG WITH_XDEBUG=false
ARG GITHUB_TOKEN

COPY --from=composer@sha256:8209324ed15c43af0c5cc900cbb9fd01e94b84a94c4bb0969aa95d31d2d7e43d /usr/bin/composer /usr/local/bin/composer

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
