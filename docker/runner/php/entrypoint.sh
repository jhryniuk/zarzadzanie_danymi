#!/bin/bash

if [ ! -d /var/www/html/vendor ]; then
    cd /var/www/html
    composer install
    php bin/console doc:sch:upd -f
fi

if [ ! -d /var/www/auth/vendor ]; then
    cd /var/www/auth
    composer install
    php bin/console doc:sch:upd -f
fi

php-fpm
