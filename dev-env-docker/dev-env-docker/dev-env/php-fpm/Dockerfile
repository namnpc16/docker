FROM php:7.3-fpm-alpine

RUN apk update
RUN apk add git
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

# Configure non-root user.
ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

RUN apk add shadow && usermod -u ${PGID} www-data && groupmod -g ${PGID} www-data && \
    mkdir -p /var/www/app && \
    chown -R www-data.www-data /var/www/app

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN echo "* * * * *  /usr/local/bin/php /var/www/app/artisan schedule:run && chown -R www-data:www-data /var/www/app/storage/logs  >> /dev/null 2>&1" >> /var/spool/cron/crontabs/root


COPY docker-php-entrypoint.sh /
RUN chmod +x /docker-php-entrypoint.sh
ENTRYPOINT ["/docker-php-entrypoint.sh"]

WORKDIR /var/www/app
EXPOSE 9000
