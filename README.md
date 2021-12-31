# Laravel Phenolink

## Installation

Install all the dependencies using composer

    `composer i`

Copy the example env file and make the required configuration changes in the .env file

    `cp .env.example .env`

Generate a new application key

    `php artisan key:generate`

Generate a new JWT authentication secret key

    `php artisan jwt:secret`

Run the database migrations and seeder (**Set the database connection in .env before migrating**)
**Make sure you set the correct database connection information before running the migrations**

    `php artisan migrate:fresh --seed`

## Dependencies
- [jwt-auth](https://github.com/tymondesigns/jwt-auth) - For authentication using JSON Web Tokens

