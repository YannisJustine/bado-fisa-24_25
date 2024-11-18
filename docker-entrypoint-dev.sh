#!/bin/bash

if [ ! -d "vendor" ]; then
  composer install
fi

if [ ! -d "node_modules" ]; then
  npm install
fi

npm run dev -- --host &

php artisan queue:work &
php artisan schedule:work &

php artisan serve --host=0.0.0.0 --port=8000