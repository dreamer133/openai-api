FROM php:8.3-fpm

RUN apt-get update -y \
    && apt-get install -y nginx

ENV PHP_CPPFLAGS="$PHP_CPPFLAGS -std=c++11"

RUN apt-get update
RUN apt-get install -y gcc
RUN apt-get install -y curl
RUN apt-get install -y libcurl4-openssl-dev
RUN docker-php-ext-install curl
RUN docker-php-ext-enable curl
RUN apt-get install -y sqlite3

COPY nginx-site.conf /etc/nginx/sites-enabled/default
COPY entrypoint.sh /etc/entrypoint.sh

COPY --chown=www-data:www-data . /var/www/openai-api

WORKDIR /var/www/openai-api
 
EXPOSE 80 443

ENTRYPOINT ["sh", "/etc/entrypoint.sh"]