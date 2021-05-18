FROM php:7-apache

RUN apt-get update && apt-get install apt-file -y && apt-file update && apt-get install vim -y && apt-get install netcat -y

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf