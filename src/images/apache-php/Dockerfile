FROM php:5.4-apache

EXPOSE 80
RUN apt-get update \
  && apt-get install vim -y \

  # && apt-get install lib64 -y \
  && apt-get install netcat -y \
  && apt-get install libpng12-0 -y \
  && apt-get install libpng12-dev -y \
  && apt-get install libmcrypt-dev -y 
  # && apt-get install libpng3 -y 
  # && apt-get install libpnglite-dev -y \
  # && apt-get install libldap-2.4-2 -y \
  # && apt-get install libldap2-dev
  
RUN apt-get install -y php5-cli \
        php5-dev \
        # php5-pear \
        php5-mysql \ 
        # php5-mysqlnd \
        php5-gd \
        php5-mcrypt \
        php5-ldap \
        php5-mhash \
        php5-cgi

RUN docker-php-ext-install mysql mysqli pdo pdo_mysql gd mcrypt 

# RUN docker-php-ext-enable mysql mysqli pdo pdo_mysql

COPY src/images/apache-php/000-default.conf /etc/apache2/sites-available/000-default.conf

COPY src/images/apache-php/apache2.conf /etc/apache2/apache2.conf
COPY src/images/apache-php/php.ini /usr/local/etc/php/php.ini

COPY src/images/apache-php/start-apache /usr/local/bin

COPY src/content/my.cnf /etc/mysql/my.cnf

RUN chmod 755 -R /var/www
RUN chown -R www-data:www-data /var/www

# RUN ln -sf /dev/stdout /var/log/apache2/access.log

# RUN ln -sf /dev/stderr /var/log/apache2/error.log

RUN a2enmod rewrite

COPY src/content/www.p2erls.net /var/www/
# 
# CMD ["php", "--with-mysql"]