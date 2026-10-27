FROM node:24 AS build

WORKDIR /home/site

COPY resources/ ./resources
COPY public/ ./public
COPY vite.config.js package.json package-lock.json ./

RUN npm ci && npm run build

FROM php:8.5-apache AS production

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y libmcrypt-dev libfreetype6-dev vim \
  libjpeg62-turbo-dev libpng-dev libxml2-dev libzip-dev libicu-dev zlib1g-dev curl git openssh-client \
  && rm -rf /var/lib/apt/lists/* \
  && docker-php-ext-install gd zip bcmath intl mysqli pdo_mysql\
  && docker-php-source delete \
  # composer taken from (https://github.com/geshan/docker-php-composer-alpine)
  && curl -sSL https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
  && a2enmod rewrite \
  && a2enmod remoteip \
  && a2enmod headers \
  && a2enmod expires \
  && a2enmod deflate

# Production PHP settings: hide errors and PHP version, bigger OPcache, larger admin uploads.
# validate_timestamps stays on: theme files are edited on the server without rebuilding.
RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
  && { \
    echo 'expose_php = Off'; \
    echo 'variables_order = "EGPCS"'; \
    echo 'memory_limit = 256M'; \
    echo 'upload_max_filesize = 16M'; \
    echo 'post_max_size = 20M'; \
    echo 'max_input_vars = 5000'; \
    echo 'realpath_cache_size = 4096K'; \
    echo 'realpath_cache_ttl = 600'; \
    echo 'opcache.enable = 1'; \
    echo 'opcache.memory_consumption = 192'; \
    echo 'opcache.interned_strings_buffer = 16'; \
    echo 'opcache.max_accelerated_files = 20000'; \
    echo 'opcache.validate_timestamps = 1'; \
    echo 'opcache.revalidate_freq = 2'; \
  } > "$PHP_INI_DIR/conf.d/zz-pixelax.ini" \
  && { \
    echo 'ServerTokens Prod'; \
    echo 'ServerSignature Off'; \
  } > /etc/apache2/conf-available/zz-pixelax.conf \
  && a2enconf zz-pixelax

USER www-data

COPY --chown=www-data:www-data app ./app
COPY --chown=www-data:www-data bootstrap ./bootstrap
COPY --chown=www-data:www-data config ./config
COPY --chown=www-data:www-data database ./database
COPY --chown=www-data:www-data public ./public
COPY --chown=www-data:www-data resources ./resources
COPY --chown=www-data:www-data storage ./storage
COPY --chown=www-data:www-data plugins ./plugins
COPY --chown=www-data:www-data routes ./routes
COPY --chown=www-data:www-data artisan .htaccess composer.json composer.lock index.php server.php ./
COPY --from=build --chown=www-data:www-data /home/site/public/assets/vendor ./public/assets/vendor
COPY --from=build --chown=www-data:www-data /home/site/public/build ./public/build
COPY --from=build --chown=www-data:www-data /home/site/public/build ./public/assets/build

RUN composer install --no-ansi --no-dev --no-interaction --no-plugins --no-progress --no-scripts --optimize-autoloader && \
    php artisan storage:link

EXPOSE 80
