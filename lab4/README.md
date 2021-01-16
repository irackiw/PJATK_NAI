Recommendation system
==============

Film recommendation system created for university purpose.

[EuclideanDistance calculation class](symfony/src/Service/EuclideanDistanceCalculatorService.php
)

# Installation

Requirements:

- docker-sync
- docker-compose

Add to /etc/hosts

```bash
127.0.0.1 symfony.localhost
```

### How to run:

Run docker files sync

```bash
$ docker-sync start
```

Build containers

```bash
$ docker-compose up -d 
```

Get into container

```bash
$ docker exec -it php-fpm /bin/sh
```

Install composer dependencies (exec from docker php container)

```bash
$ composer install
```

Import scores from csv [file](symfony/public/files/sample.csv)  (exec from docker php container)

```bash
$ bin/console rate:import-csv
```

Visit [symfony.localhost](http://symfony.localhost) 

