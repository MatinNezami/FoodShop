yum -y update;

yum -y install nginx;
yum -y install mysql-server;

cd /tmp;
curl https://www.php.net/distributions/php-8.1.4.tar.xz -o php-8.1.4.tar.xz;

unxz php-8.1.4.tar.xz;
tar xf php-8.1.4.tar;

cd php-8.1.4;
./configure --with-pdo-mysql;
make install;

setsebool -P httpd_can_network_connect=1;
setsebool -P httpd_can_network_connect_db=1;

#mv -f +++ your nginx.conf +++ /etc/nginx;
#rm -fr /var/www/html/*;
#cp -rf +++ your push code from githum +++ /var/www/html;
