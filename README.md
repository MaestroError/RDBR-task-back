# RDBR-task-back

### Installation
##### Step 1
First of all copy .env.example file to .env (`cp .env.example .env`) and edit your DB credentials.
##### Step 2
Run following commands:
```
composer install
php artisan key:generate
php artisan migrate
// seed with exaple user and fetch countries
php artisan db:seed
// fetch statistics
php artisan get:statistics
```
###### Linux
if you are on Linux/Debian system just run in root of projects:
```
chmod 755 install.sh
./install.sh
```