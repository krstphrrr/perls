FROM php:5.4-apache

EXPOSE 80
RUN apt-get update && apt-get install vim -y && apt-get install netcat -y

COPY src/images/apache-php/000-default.conf /etc/apache2/sites-available/000-default.conf

COPY src/images/apache-php/apache2.conf /etc/apache2/apache2.conf
COPY src/images/apache-php/php.ini /usr/local/etc/php/php.ini

COPY src/images/apache-php/start-apache /usr/local/bin

RUN chmod 755 -R /var/www
# RUN chown -R www-data:www-data /var/www

# RUN ln -sf /dev/stdout /var/log/apache2/access.log

# RUN ln -sf /dev/stderr /var/log/apache2/error.log

RUN a2enmod rewrite

COPY src/content/www.p2erls.net /var/www/
# 
# CMD ["php", "--with-mysql"]