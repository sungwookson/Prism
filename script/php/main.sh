#!/bin/bash

APACHE_DIR="/etc/httpd"
APACHE_CONF_DIR="/etc/httpd/conf.d"
MRTG_CONF_DIR="./mrtgphp.conf"

cp $MRTG_CONF_DIR $APACHE_CONF_DIR

#service httpd restart