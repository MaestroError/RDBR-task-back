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
// seeds DB with test user and fetchs countries
php artisan db:seed
// fetchs statistics
php artisan get:statistics
```
###### Linux
if you are on Linux/Debian system just run in root of project:
```
chmod 755 install.sh
./install.sh
```