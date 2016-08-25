# stones

Given a heap of stones, and that each opponent may take between one and three from the pile, who
will take the last stone?

## Get started

```
composer install
composer run-script test
php demo.php 15
```

alternatively, run in docker in isolation:

```
docker run --rm -v $(pwd):/app composer/composer:1.1-php5 install
docker run --rm -v $(pwd):/app -w /app php:5.5 php ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests
docker run --rm -v $(pwd):/app -w /app php:5.5 php ./demo.php 15
```
