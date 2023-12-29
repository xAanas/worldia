Worldia Technical Test
========================

The "Worldia Technical Test" is a refactoring exercise for back-end developers.

Installation
------------

1. Spin up a php Docker container

```shell
docker compose up -d
docker compose exec php sh
```

2. Install dependencies with Composer

```shell
docker compose exec php composer install
```

Tests
-----

To run the tests, execute this command:

```bash
docker compose exec php vendor/bin/phpunit
```
