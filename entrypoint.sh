#!/bin/bash

# Make sure the entire writable directory is writable.
chmod 777 /var/www/writable -R

composer install

source /etc/apache2/envvars
tail -F /var/log/apache2/* &
exec apache2 -D FOREGROUND
