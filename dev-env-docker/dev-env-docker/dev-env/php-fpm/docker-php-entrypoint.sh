#!/bin/sh

# Start crond in background
/usr/sbin/crond

/usr/local/sbin/php-fpm

#chown -R 1000:www-data /var/www/html/storage/logs
#chown -R www-data:www-data /var/www
