# Laravel Starter App

Starter boilerplate sample app on Laravel-9 with authorization and admin panel.
Includes PHP-8, Mysql-5, Composer-2, Cron.

## [Project objectives](./TASK.md)

## Installation with [Docker](https://docs.docker.com/get-docker/)

1) `docker-compose up -d`

2) `docker-compose exec php composer install --ignore-platform-reqs`

3) `docker-compose exec php php artisan key:generate`

4) `docker-compose exec php php artisan migrate`

5) `docker-compose exec php php artisan db:seed`

## Usage

Home page: [http://localhost:8000](http://localhost:8000)

Admin panel: [http://localhost:8000/admin](http://localhost:8000/admin)

You may merge `src/.env.example` with `src/.env` to use full set of Laravel config variables

### Default admin user credentials

- login: `admin@localhost`

- password: `admin`

To stop services, run: `docker-composer stop`

And to terminate them: `docker-composer down` 

## PHP CLI

Enter php container TTY (bash shell):

`docker-compose exec php bash`

## Mysql CLI

Enter mysql container CLI (mysql command line client):

`docker-compose exec db mysql -u dev_laravel -ppassword dev_laravel -h db`

Dump database to sql file:

`docker-compose exec db mysqldump -u dev_laravel -ppassword dev_laravel > dump.sql`

## Update PHP autoload index

- `docker-compose exec php composer dump-autoload -a`

## Clean and regenerate Laravel cache

- `docker-compose exec php php artisan config:clear`

- `docker-compose exec php php artisan view:clear`

- `docker-compose exec php php artisan cache:clear`

- `docker-compose exec php php artisan config:cache`

## Work with frontend

1) `npm i` - setup node_modules

2) `npm run prod`- build production bundle with mixer

## Setup app without docker

- Copy content of `src` dir to PHP-Laravel enabled host,
  `src/public` directory should match web server document root

- Load `src/database/db.sql` into DB

- Edit `src/.env` variables to make working DB connection