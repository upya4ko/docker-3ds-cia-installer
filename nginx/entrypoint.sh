#!/bin/sh

localIp=$(ip route | grep -v linkdown | grep -v default | cut -f 9 -d ' ' | tail -n 1)

#/usr/sbin/nginx -t \
#  && /usr/sbin/nginx

/usr/sbin/nginx

echo "\n\n Open in browser http://$localIp \n\n"

/usr/bin/php-cgi -b 127.0.0.1:9123

