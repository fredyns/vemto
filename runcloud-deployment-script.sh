git reset --hard HEAD
git pull

# file
chmod -R 775 *.sh

# app migrations

composer dump-autoload -o
composer update
npm update
npm run build

# app codes

php artisan optimize:clear
php artisan livewire:publish --assets
php artisan queue:restart

# reset DB
php artisan migrate
