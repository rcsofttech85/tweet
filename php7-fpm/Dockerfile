FROM php:7.2-fpm
ARG TIMEZONE

RUN apt-get update && apt-get install -y git unzip openssl procps acl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone
RUN printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini

# Install PDO extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Redis extension
RUN pecl install -o -f redis && rm -rf /tmp/pear && docker-php-ext-enable redis

# npm & node
RUN apt-get install -y wget gnupg
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash
RUN apt-get install -y wget nodejs npm \
  && update-alternatives --install /usr/bin/node node /usr/bin/nodejs 10
# build tools
RUN apt-get install -y build-essential

# bugfix: remove cmdtest to install yarn correctly.

RUN apt-get remove --auto-remove cmdtest

# yarn package manager

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
  && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list


RUN apt-get update && apt-get install -y yarn zlib1g-dev
RUN docker-php-ext-install zip
RUN pecl install xdebug && docker-php-ext-enable xdebug

# for phpunit test install zlib1g-dev
# RUN docker-php-ext-install zip
# RUN pecl install xdebug && docker-php-ext-enable xdebug

WORKDIR /var/www/symfony
