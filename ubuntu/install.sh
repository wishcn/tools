#!/bin/sh

# install subversion
sudo apt-get install git

# install editer
sudo apt-get install vim
sudo apt-get install emacs

# install bash
sudo apt-get install zsh
wget https://github.com/robbyrussell/oh-my-zsh/raw/master/tools/install.sh -O - | sh
chsh -s /bin/zsh
sudo apt-get install tmux

# tmux config
conf=$(cat <<EOF
set -g prefix C-l
unbind C-b
EOF
)
echo $conf > ~/.tmux.conf

# install chromium
:<<\EOF
ubuntu 软件中心 > 搜索chromium > 选择安装
EOF

# install tweak
:<<\EOF
ubuntu 软件中心 > tweak > unity tweak tool && 调整工具
EOF

# install lwqq
sudo add-apt-repository ppa:lainme/pidgin-lwqq
sudo apt-get update
sudo apt-get install pidgin-lwqq
sudo apt-get install pidgin

# install dnsmasq && dnscrypt-proxy && apparmor
sudo apt-get install dnsmasq
# 为了方便日后更新，把这个仓库 clone 到本地而不是直接下载。
git clone https://github.com/felixonmars/dnsmasq-china-list.git
# 创建到 DNSMasq 配置目录的软链接，当前该目录在 /root/dnsmasq-china-list 下。
sudo ln -s ~/root/dnsmasq-china-list/accelerated-domains.china.conf /etc/dnsmasq.d/
sudo ln -s ~/dnsmasq-china-list/bogus-nxdomain.china.conf /etc/dnsmasq.d/
sudo apt-add-repository ppa:shnatsel/dnscrypt
sudo apt-get update
sudo apt-get install dnscrypt-proxy
sudo vim /etc/default/dnscrypt-proxy
:<<\EOF
local-address=127.0.0.1:5301
resolver-address=106.186.17.181:2053
provider-name=2.dnscrypt-cert.ns2.jp.dns.opennic.glue
provider-key=8768:C3DB:F70A:FBC6:3B64:8630:8167:2FD4:EE6F:E175:ECFD:46C9:22FC:7674:A1AC:2E2A
EOF
sudo vim /etc/dnsmasq.conf
dnscrypt-proxy --daemonize --user=dnscrypt
sudo service dnsmasq restart
sudo apt-get install apparmor-utils
sudo aa-complain /etc/apparmor.d/usr.sbin.dnscrypt-proxy

# install apache && php && mysql
sudo apt-get install apache2
sudo apt-get install libapache2-mod-php5 php5
sudo apt-get install mysql-server mysql-client

# install yaf
sudo add-apt-repository ppa:mikespook/php5-yaf
sudo apt-get update
sudo apt-get install php5-yaf
sudo service apache2 restart

# adjust display light
sudo vim /etc/rc.local
:<<\EOF
echo 60 > /sys/class/backlight/acpi_video0/brightnessecho 60 > /sys/class/backlight/acpi_video0/brightness
EOF

# close bluetooth
sudo vim /etc/rc.local
:<<\EOF
rfkill block bluetoothr
EOF

# adjust time
sudo vim /etc/default/rcS
:<<\EOF
UTC=no
EOF
