# RDBR-task-back

### Installation
First of all copy .env.example file to .env (`cp .env.example .env`) and edit your DB credentials, after Please run following commands:
```
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
```