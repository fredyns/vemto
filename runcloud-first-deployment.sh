# first install

composer update
npm install
npm update
npm run build
php artisan key:generate
php artisan storage:link

# app codes

php artisan optimize:clear
php artisan livewire:publish --assets

# reset DB
php artisan migrate:fresh --seed # --force
