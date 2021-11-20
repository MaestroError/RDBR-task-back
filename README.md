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

### Run
After installation run:
```
php artisan test (optional)
php artisan serve
// OR
php artisan octane:start
```

#### P.S.

if you get this error on `composer install`:
```
Your lock file does not contain a compatible set of packages. Please run composer update.

  Problem 1
    - spiral/goridge is locked to version v3.1.1 and an update of this package was not requested.
    - spiral/goridge v3.1.1 requires ext-sockets * -> it is missing from your system. Install or enable PHP's sockets extension.
    - spiral/roadrunner-worker is locked to version v2.1.4 and an update of this package was not requested.
    - spiral/roadrunner-worker v2.1.4 requires ext-sockets * -> it is missing from your system. Install or enable PHP's sockets extension.
  Problem 3
    - spiral/roadrunner-worker v2.1.4 requires ext-sockets * -> it is missing from your system. Install or enable PHP's sockets extension.
    - spiral/roadrunner-http v2.0.4 requires spiral/roadrunner-worker ^2.0 -> satisfiable by spiral/roadrunner-worker[v2.1.4].
    - spiral/roadrunner-http is locked to version v2.0.4 and an update of this package was not requested.
```
Enable 'sockets' extension from your php.ini file and run `composer update`