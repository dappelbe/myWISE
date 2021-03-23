FROM php:7.4-apache
USER root
WORKDIR /var/www/html
RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        unzip \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-source delete \
    && pecl install xdebug-3.0.1 \
    && docker-php-ext-enable xdebug

COPY Docker/www/php.ini /usr/local/etc/php/conf.d/template-php.ini
COPY Docker/www/vhost.conf /etc/apache2/sites-available/000-default.conf
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

# sendmail config
#################
#ARG SMTP_PASSWORD=not_provided
# install
#RUN apt-get install -q -y msmtp mailutils
# config
#COPY Docker/www/msmtprc /etc/msmtprc
#RUN chmod 600 /etc/msmtprc
#RUN chown www-data:www-data /etc/msmtprc
#ARG SMTP_PASSWORD=not_provided
#RUN sed -i "s|YourAwesomeStr0ngP4zzw0rd|$SMTP_PASSWORD|g" /etc/msmtprc
# Set up php sendmail config
#RUN echo "sendmail_path=/usr/bin/msmtp -t" >> /etc/php/7.4/apache2/conf.d/php-sendmail.ini