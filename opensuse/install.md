# git
zypper in git
# subversion
zypper in subversion
# zsh
zypper in zsh
# emacs
zypper in emacs
# idea
wget http://idea.com
cp idea /usr/local/share/
# maven2
wget http://maven2.com
# apache-tomcat
wget http://tomcat.com

# apache
zypper install apache2 
启动服务 
systemctl enable apache2.service 
systemctl start apache2.service 
# php php-curl php-memcached php-pdo php-memcache php-mysql
zypper install php5 php5-mysql apache2-mod_php5
a2enmod php5
# mysql server
zypper install mysql-community-server mysql-community-server-client 
启动服务 
systemctl enable mysql.service 
systemctl start mysql.service 
初始化数据库命令： 
mysql_secure_installation 

# workrave
wget http://www.workrave.org/download/
./configure
make && make install 
# chromium
zypper install chromium
# chrome
zypper install google-chrome-stable_current_x86_64.rpm
# lwqq+pidgin
zypper in http://gmg137.googlecode.com/files/pidgin-lwqq-1.0c-1.1.x86_64.rpm
zypper in --force http://gmg137.googlecode.com/files/pidgin-lwqq-1.0c-1.1.x86_64.rpm
zypper install pidgin
# vbox
zypper remove vbox-gtk
zypper in vbox-qt
