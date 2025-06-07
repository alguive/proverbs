#!/bin/sh

cd /var/www/html

export APP_ENV=${APP_ENV:-prod}
export APP_DEBUG=${APP_DEBUG:-0}

echo "COMPOSER INSTALL"
if [ ! -d "vendor" ]; then
    COMPOSER_MEMORY_LIMIT=-1 composer install --optimize-autoloader --no-interaction --no-progress
else
    echo "VENDOR EXIST"
fi

echo "CLEAR CACHE"
php bin/console cache:clear --env=$APP_ENV --no-debug

echo "WARMUP CACHE"
php bin/console cache:warmup --env=$APP_ENV --no-debug

echo "SETTING PERMISSIONS"
chown -R www-data:www-data var public
chmod -R 775 var public

exec "$@"
