#FROM php:7-fpm
FROM php:7.0-apache

ENV DEBIAN_FRONTEND noninteractive

RUN echo "force-unsafe-io" > /etc/dpkg/dpkg.cfg.d/02apt-speedup

RUN echo "Acquire::http {No-Cache=True;};" > /etc/apt/apt.conf.d/no-cache

RUN apt-get update && apt-get install -y \
        g++ \
        libicu-dev \
        libc-client-dev \
        libkrb5-dev \
        libssl-dev \
        unzip \
        zip \
        libfreetype6-dev \
        libjpeg-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        zlib1g-dev \
        mysql-client \
        openssh-client \
        libxml2-dev \
        curl \
        libxslt1-dev \
        libcurl4-gnutls-dev \
        --no-install-recommends && \
        apt-get clean && \
        rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-configure imap --with-imap --with-imap-ssl --with-kerberos
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/ && \
    docker-php-ext-configure bcmath && \
    docker-php-ext-install -j$(nproc) gd \
                                    intl \
                                    xsl \
                                    json \
                                    zip \
                                    bcmath \
                                    soap \
                                    mcrypt \
                                    mysqli \
                                    pdo_mysql

COPY . /var/www/html
COPY php.ini /usr/local/etc/php/
COPY 000-default.conf /etc/apache2/sites-available/
COPY entrypoint.sh /entrypoint.sh
COPY triangle.crontab /etc/cron.d/triangle
RUN chown -R www-data:www-data /var/www/html
RUN chmod 755 -R /var/www/html
RUN chmod 777 /entrypoint.sh
#WORKDIR /var/www/html
EXPOSE 80
ENTRYPOINT ["/entrypoint.sh"]
CMD ["apache2-foreground"]
