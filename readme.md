# OKR app

## Getting started

```console
$ composer install
$ npm install
$ php artisan migrate
```

## Using original-docker

1. download docker

- https://docs.docker.com/docker-for-mac/
- https://docs.docker.com/docker-for-windows/

2. clone repo
```
git clone https://github.com/mtmtkj/okr_laravel.git
```

3. run docker-compose up

```
docker-compose up -d
```

4. create database

key | value
--- | ---
host | 127.0.0.1
user | root
pass | root

```
create database stal;
```

5. enter workspace and run composer
``` 
docker-compose exec workspace bash
composer install
```

5. enter workspace and run composer & npm
``` 
docker-compose exec -it stal /bin/bash
cd /var/www/html
composer install
npm install
```

6. modfiy .env file
```
cp .env.example .env
vi .env
```
```
DB_CONNECTION=mysql
DB_HOST=stal-db
DB_PORT=3306
DB_DATABASE=stal
DB_USERNAME=root
DB_PASSWORD=root
```

7. run artisan
```
docker-compose exec -it stal bash
cd /var/www/html
php artisan key:generate
php artisan migrate
```

8. access localhost: http://localhost in browser

9. you're done!

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
