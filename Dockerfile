FROM node:20-alpine AS assets-builder

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY resources ./resources
COPY public/assets ./public/assets
RUN npm run build:css

FROM php:8.2-apache

WORKDIR /var/www/html

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN apt-get update \
    && apt-get install -y libpq-dev libsqlite3-dev \
    && a2enmod rewrite \
    && sed -ri "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/sites-available/*.conf \
    && sed -ri "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && docker-php-ext-install pdo_mysql pdo_pgsql pdo_sqlite \
    && { \
        echo 'ServerName localhost'; \
      } > /etc/apache2/conf-available/server-name.conf \
    && a2enconf server-name \
    && { \
        echo 'log_errors=On'; \
        echo 'error_log=/proc/self/fd/2'; \
        echo 'display_errors=Off'; \
        echo 'display_startup_errors=Off'; \
      } > /usr/local/etc/php/conf.d/docker-php-logging.ini \
    && rm -rf /var/lib/apt/lists/*

COPY app ./app
COPY database ./database
COPY docker/start-web.sh /usr/local/bin/start-web.sh
COPY public ./public
COPY --from=assets-builder /app/public/assets/css ./public/assets/css

RUN chmod +x /usr/local/bin/start-web.sh \
    && chown -R www-data:www-data /var/www/html

CMD ["start-web.sh"]
