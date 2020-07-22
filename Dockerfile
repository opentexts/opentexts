FROM ubuntu

ENV OS_LOCALE="en_US.UTF-8"
RUN apt-get update && apt-get install -y locales && locale-gen ${OS_LOCALE}
ENV LANG=${OS_LOCALE} \
    LANGUAGE=${OS_LOCALE} \
    LC_ALL=${OS_LOCALE} \
    DEBIAN_FRONTEND=noninteractive

ENV APACHE_CONF_DIR=/etc/apache2 \
    PHP_CONF_DIR=/etc/php/ \
    PHP_DATA_DIR=/var/lib/php

COPY . /var/www/
COPY entrypoint.sh /sbin/entrypoint.sh

RUN	\
    BUILD_DEPS='software-properties-common' \
    && dpkg-reconfigure locales \
    && apt-get install --no-install-recommends -y $BUILD_DEPS \
    && apt-get update \
    && apt-get install -y curl apache2 libapache2-mod-php php php-cli php-readline php-mbstring php-zip php-intl php-xml php-json php-curl php-gd php-pgsql php-mysql php-pear \
    # Apache settings
    && cp /dev/null ${APACHE_CONF_DIR}/conf-available/other-vhosts-access-log.conf \
    && rm ${APACHE_CONF_DIR}/sites-enabled/000-default.conf ${APACHE_CONF_DIR}/sites-available/000-default.conf \
    && a2enmod rewrite \
    # Install composer
    && curl -sS https://getcomposer.org/installer | php -- --version=1.8.4 --install-dir=/usr/local/bin --filename=composer \
    && apt-get purge -y --auto-remove $BUILD_DEPS \
    && apt-get autoremove -y \
    && rm -rf /var/lib/apt/lists/* \
    # Forward logs to docker log collector
    && ln -sf /dev/stdout /var/log/apache2/access.log \
    && ln -sf /dev/stderr /var/log/apache2/error.log \
    && chmod 755 /sbin/entrypoint.sh \
    && chown www-data:www-data ${PHP_DATA_DIR} -Rf

COPY ./docker-configs/apache2.conf ${APACHE_CONF_DIR}/apache2.conf
COPY ./docker-configs/app.conf ${APACHE_CONF_DIR}/sites-enabled/app.conf
COPY ./docker-configs/php.ini  ${PHP_CONF_DIR}/apache2/conf.d/custom.ini

WORKDIR /var/www

RUN composer install

EXPOSE 80 443

# By default, simply start apache.
CMD ["/sbin/entrypoint.sh"]
