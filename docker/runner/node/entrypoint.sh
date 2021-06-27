#!/bin/bash

cd /var/www

#ng n datamanagement --directory ./ --style=scss --routing=true --skip-tests=true

if [ ! -d /var/www/node_modules ]; then
  npm install --legacy-peer-deps
  npm run start
else
  npm run start
fi
