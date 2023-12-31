# first install

composer update
composer dump-autoload -o
npm install
npm update
npm run build
php artisan key:generate
php artisan storage:link

# app codes

php artisan optimize:clear
php artisan livewire:publish --assets
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

# reset DB
php artisan migrate:fresh --seed # --force
