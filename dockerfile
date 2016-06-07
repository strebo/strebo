FROM ubuntu:14.04

WORKDIR /etc

RUN apt-get update &&\ 
apt-get install -y autoconf libxml2-dev build-essential libcurl4-openssl-dev pkg-config apache2-prefork-dev git curl wget apache2 &&\
wget http://www.php.net/distributions/php-7.0.6.tar.gz &&\
wget http://pecl.php.net/get/pthreads-3.1.6.tgz &&\
tar zxvf php-7.0.6.tar.gz &&\
tar zxvf pthreads-3.1.6.tgz &&\
rm -r php-7.0.6.tar.gz &&\
rm -r pthreads-3.1.6.tgz &&\
mv php-7.0.6 php7 &&\
mv pthreads-3.1.6 pthreads &&\
mv pthreads php7/ext/

WORKDIR php7/

RUN rm -rf aclocal.m4 &&\
rm -rf autom4te.cache/ &&\
./buildconf --force &&\
./configure --enable-debug --enable-maintainer-zts --enable-pthreads --enable-sockets --enable-mbstring --with-curl --with-openssl --prefix=/usr --with-config-file-path=/etc &&\
make &&\
make install &&\
cp php.ini-development /etc/php.ini

WORKDIR /etc

RUN wget https://curl.haxx.se/ca/cacert.pem &&\
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer &&\
#sed '/^include_path = /d' /etc/php.ini &&\
#sed '/^curl.cainfo=/d' /etc/php.ini &&\
echo 'include_path = "usr/local/lib/php"' >> /etc/php.ini &&\
echo "curl.cainfo=/etc/cacert.pem" >> /etc/php.ini &&\
curl -sL https://deb.nodesource.com/setup_6.x | sudo -E bash - &&\
sudo apt-get install -y nodejs

WORKDIR /var/www/html

RUN rm index.html &&\
git clone https://github.com/strebo/strebo.git . &&\
composer install &&\
composer update &&\
composer install &&\
npm install

EXPOSE 80 443 8080

CMD service apache2 start && php start.php
