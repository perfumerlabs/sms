#!/usr/bin/env bash

set -x \
&& rm -rf /etc/nginx \
&& rm -rf /etc/supervisor \
&& mkdir /run/php

set -x \
&& cp -r "/usr/share/container_config/nginx" /etc/nginx \
&& cp -r "/usr/share/container_config/supervisor" /etc/supervisor

sed -i "s/SMS_HOST/$SMS_HOST/g" /etc/nginx/sites/sms.conf

sed -i "s/error_log = \/var\/log\/php7.4-fpm.log/error_log = \/dev\/stdout/g" /etc/php/7.4/fpm/php-fpm.conf
sed -i "s/;error_log = syslog/error_log = \/dev\/stdout/g" /etc/php/7.4/fpm/php.ini
sed -i "s/;error_log = syslog/error_log = \/dev\/stdout/g" /etc/php/7.4/cli/php.ini
sed -i "s/log_errors = Off/log_errors = On/g" /etc/php/7.4/cli/php.ini
sed -i "s/log_errors = Off/log_errors = On/g" /etc/php/7.4/fpm/php.ini
sed -i "s/log_errors_max_len = 1024/log_errors_max_len = 0/g" /etc/php/7.4/cli/php.ini
sed -i "s/user = www-data/user = sms/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/group = www-data/group = sms/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/pm = dynamic/pm = static/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/pm.max_children = 5/pm.max_children = ${PHP_PM_MAX_CHILDREN}/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/;pm.max_requests = 500/pm.max_requests = ${PHP_PM_MAX_REQUESTS}/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/listen.owner = www-data/listen.owner = sms/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/listen.group = www-data/listen.group = sms/g" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/;catch_workers_output = yes/catch_workers_output = yes/g" /etc/php/7.4/fpm/pool.d/www.conf

SMS_HOST_SED=${SMS_HOST//\//\\\/}
SMS_HOST_SED=${SMS_HOST_SED//\./\\\.}
SMSCRU_SENDER_SED=${SMSCRU_SENDER//\//\\\/}
SMSCRU_SENDER_SED=${SMSCRU_SENDER_SED//\./\\\.}
SMSCRU_USERNAME_SED=${SMSCRU_USERNAME//\//\\\/}
SMSCRU_USERNAME_SED=${SMSCRU_USERNAME_SED//\./\\\.}
SMSCRU_PASSWORD_SED=${SMSCRU_PASSWORD//\//\\\/}
SMSCRU_PASSWORD_SED=${SMSCRU_PASSWORD_SED//\./\\\.}

sed -i "s/SMS_HOST/$SMS_HOST_SED/g" /opt/sms/src/Gateway.php
sed -i "s/SMS_PROVIDER/$SMS_PROVIDER/g" /opt/sms/src/Resource/config/resources_shared.php
sed -i "s/SMS_DUMMY/$SMS_DUMMY/g" /opt/sms/src/Resource/config/resources_shared.php
sed -i "s/SMSCRU_SENDER/$SMSCRU_SENDER_SED/g" /opt/sms/src/Resource/config/resources_shared.php
sed -i "s/SMSCRU_USERNAME/$SMSCRU_USERNAME_SED/g" /opt/sms/src/Resource/config/resources_shared.php
sed -i "s/SMSCRU_PASSWORD/$SMSCRU_PASSWORD_SED/g" /opt/sms/src/Resource/config/resources_shared.php

touch /node_status_inited
