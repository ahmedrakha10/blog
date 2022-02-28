
## To run project

composer update
composer dump-autoload
php artisan config:cache
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
