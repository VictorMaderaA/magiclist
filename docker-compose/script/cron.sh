#!/bin/bash
cd /var/www
# Run scheduler
while [ true ]
do
  php artisan schedule:run --verbose --no-interaction
  sleep 1
done