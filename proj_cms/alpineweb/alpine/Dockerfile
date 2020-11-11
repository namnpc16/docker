FROM alpine:3.12

# Install packages and remove default server definition
RUN apk --no-cache add php7 php7-fpm php7-opcache php7-mysqli php7-json php7-openssl php7-curl \
    php7-zlib php7-xml php7-phar php7-intl php7-dom php7-xmlreader php7-ctype php7-session \
    php7-mbstring php7-gd php7-pdo php7-xmlwriter php7-tokenizer php7-pdo_mysql php7-fileinfo nginx supervisor curl npm && \
    rm /etc/nginx/conf.d/default.conf

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configure nginx
COPY config/nginx.conf /etc/nginx/nginx.conf

# Configure PHP-FPM
COPY config/fpm-pool.conf /etc/php7/php-fpm.d/www.conf
COPY config/php.ini /etc/php7/conf.d/custom.ini

# Configure supervisord
COPY config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
#RUN echo '* * * * * /usr/bin/php /var/www/app/artisan schedule:run >> /dev/null 2>&1' > /etc/crontabs/root


# Configure non-root user.
ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

# Make sure files/folders needed by the processes are accessable when they run under the www-data user
RUN adduser -D -u ${PUID} -g ${PGID} -s /bin/sh www-data -G www-data && \
  mkdir -p /var/www/app && \
  chown -R www-data.www-data /var/www/app && \
  chown -R www-data.www-data /run && \
  chown -R www-data.www-data /var/lib/nginx && \
  chown -R www-data.www-data /var/log/nginx

# Add application
WORKDIR /var/www/app

# Expose the port nginx is reachable on
EXPOSE 80

#USER www-data

# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
