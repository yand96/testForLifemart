FROM php:8.1-apache

RUN mkdir -p /usr/src/myapp
WORKDIR /usr/src/myapp

COPY . /usr/src/myapp

EXPOSE 8080 5432

RUN docker-php-ext-install pdo mysqli pdo_mysql

RUN chmod a+x ./run.sh

ENTRYPOINT ["./run.sh"]