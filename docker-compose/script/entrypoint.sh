#!/bin/bash

# Run scheduler
while [ true ]
do
  php artisan schedule:run --verbose --no-interaction
  sleep 1
done