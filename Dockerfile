FROM php:7.2-apache

RUN apt-get update
RUN apt-get install -y libjpeg-dev libpng-dev

# Extentions
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install sockets
RUN docker-php-ext-configure gd --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install gd

# Config
ADD ./config/time.ini /usr/local/etc/php/conf.d/
ADD ./config/servername.ini /etc/apache2/conf-available/
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
RUN a2enmod rewrite

# Port
EXPOSE 80