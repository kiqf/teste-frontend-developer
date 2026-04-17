#!/bin/sh
set -eu

mkdir -p /var/www/html/database
touch /var/www/html/database/app.sqlite

chown -R www-data:www-data /var/www/html/database
chmod -R ug+rwX /var/www/html/database

exec apache2-foreground
