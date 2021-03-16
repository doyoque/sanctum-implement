# Laravel Sanctum Implementation

Just a simple laravel sanctum implementation.

## Local Development

```bash
# git clone this repository
git clone https://github.com/doyoque/sanctum-implement.git

# move to directory
cd sanctum-implement/

# install dependency
composer install

# generate app key
php artisan key:generate

# run locally
php artisan serve
```

## Docker Development Environment (Recommended)

Make sure to have `docker-compose` installed on your computer.

```bash
# git clone this repository
git clone https://github.com/doyoque/sanctum-implement.git

# move to directory
cd sanctum-implement/

# this command will boot up nginx, MySQL, and app stack
docker-compose up
```

## Postman Collection and Environment

For collection and environment variable is available in `postman/` directory.
