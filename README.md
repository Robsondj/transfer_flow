#  Transfer Flow
## Transfer Flow is a simple flow of transfer between users
<br>

## Configuring and running
    `cp env.example .env`
    `docker-compose up -d`

## Running migrations
    `php artisan migrate`
    To clear database and run all
    `php artisan migrate:fresh`

## Running Seeders
    `php artisan db:seed`

## Running tests
    `php artisan test --filter Transfer`