#!/bin/sh

# example execute file "./init.sh ../../frameworks/yii/framework"
# execute only in protected directory

sudo chown -R www-data:www-data ../protected
sudo chown www-data:www-data ../assets

cp config/template.db.php config/db.php
cp ../template.index.php ../index.php
cp template.yiic.php yiic.php

if [ -n $1 ]; then
	sed -i "s:framwork_path:$1:g" ../index.php
	sed -i "s:framwork_path:$1:g" yiic.php
fi