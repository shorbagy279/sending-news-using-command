#!/bin/bash

/var/www/docker/wait-for-it.sh database:3306 --timeout=30 --strict

    php artisan migrate
    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear
    php artisan serve --host=0.0.0.0 --port=8000 --env=.env
