# A minimal hotel reservation system written in Laravel.

It demonstrates Contracts, Repositories, Models, Dependency injection, Controllers, FormRequests, Views, Events, some Design patterns, Unit & Functional testing.

## Set up
1. `git clone git@github.com:geobas/minimal-laravel.git landon_app`
2. Run `composer install`
3. Run `cp .env.example .env`
4. Create a database named 'landon_app' in your development environment.
5. Run `./artisan config:cache && ./artisan migrate --seed --database=mysql` from application's root folder.

## Set up unit & functional testing
1. Create a database named 'landon_app_test' in your development environment.
2. Run `./artisan config:cache --env=testing && ./artisan migrate --database=mysql_test` from application's root folder.

## Run tests
1. Run `phpunit tests/` from application's root folder.