FROM php:7-apache

RUN apt-get update -y && apt-get install -y libpng-dev curl libcurl4-openssl-dev libmemcached-dev

RUN docker-php-ext-install curl

RUN service apache2 restart