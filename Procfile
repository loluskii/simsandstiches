web: vendor/bin/heroku-php-nginx -C nginx.conf public/
worker: php artisan queue:work --sleep=3 --tries=3 --daemon
# web:  vendor/bin/heroku-php-apache2 public/
# worker: php artisan queue:work --sleep=3 --tries=3 --daemon
