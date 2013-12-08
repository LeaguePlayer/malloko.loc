#!/bin/bash

sudo chown -R www-data:www-data ../protected
sudo chown www-data:www-data ../assets

cp config/template.db.php config/db.php
cp ../template.index.php ../index.php
cp template.yiic.php yiic.php