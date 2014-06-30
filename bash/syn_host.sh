#!/bin/sh

wget https://git.oschina.net/kawaiiushio/misc/raw/master/hosts/pc/hosts -O /tmp/hosts
sed -i '/www.dropbox.com/d' hosts
sed -i '/ dropbox.com/d' hosts
cd /home/xxstop/share/dnsmasq-china-list/
git pull origin master
mv /tmp/hosts /etc/hosts.dnsmasq.fq
service dnsmasq restart
