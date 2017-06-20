FROM php:7.1-fpm

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y \
        git \
        unzip \
        libssl-dev && \
    rm -rf /var/lib/apt/lists/*

WORKDIR /var/www

RUN rm -rf * && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

ADD ./composer.json /var/www/composer.json
ADD ./composer.lock /var/www/composer.lock

RUN composer install

ADD ./behat.yml /var/www/behat.yml
ADD ./tests /var/www/tests
ADD ./web /var/www/web
