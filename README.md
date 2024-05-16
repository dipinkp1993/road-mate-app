1.Installed Laravel
   composer create-project laravel/laravel road-mate
2.Installed Laravel Breeze(starter kit)
      composer require laravel/breeze –dev

php artisan breeze:install
 
php artisan migrate

npm install

npm run dev
3. Laravel 11 is installed. Since its default database is SQLite. There was a need to set it to MySQL host before migration
4. Laravel Breeze is installed with Livewire. Livewire volt is used where logic and blade elements co-exist in the same file
5. Product model was created with migration- php artisan make: model Product -m
