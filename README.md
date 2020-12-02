# Introduction

This is a laravel 8 CURD api with docker for following:

- laravel app
- Nginx
- MYSQL database [user=root, password=root, database=laravel, host=db]
- Adminer for DB management [http://localhost:8080](http://localhost:8080)

# Setup
Build and start docker containers
```
docker-compose up
```

Setup app container and create 'user' table
```
docker-compose exec app bash
composer install
php artisan migrate
php artisan db:seed --class=UserTableSeeder
```

- Acess default Laravel 8 page at [http://localhost](http://localhost)

- Acess user list API at [http://localhost/api/users](http://localhost/api/users)

- Acess UI at [http://localhost/users](http://localhost/users)

To run mannual tests install [VSCode plugin REST Client](https://marketplace.visualstudio.com/items?itemName=humao.rest-client) and Send Request using
[/tests/Http/User.http](/tests/Http/User.http)

To run automated tests
```
php artisan test
```

# Troubleshoot

To accesss MYSQL docker container
```
$ docker-compose exec db bash
$ mysql -u root -p
mysql> use laravel;
mysql> select * from user;
```

Some useful configuration information
```
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=laravel

root user=root
password=root
```

To rebuild containers
```
docker-compose build
```

If you want your instance to be initialized, you have to start from scratch. It is quite easy to do with docker compose. Warning: this will permanently delete the contents in your db_data volume, wiping out any previous database you had there. 
```
docker-compose down -v
docker-compose up -d
```

To kill a process at port 80
```
sudo kill -9 $(sudo lsof -t -i:80)
```

To clear laravel cache
```
docker-compose exec app bash
php artisan route:clear
php artisan config:clear
php artisan cache:clear
```
