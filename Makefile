
####### VARS #######

include .env
export $(shell sed 's/=.*//' .env)

ifeq ($(APP_ENV), production)
 TYPE_ENV := prod
else
 TYPE_ENV := dev
endif

####### DOCKER #######

docker-up:
	docker compose up -d ${service}

up: docker-up


null:
	docker compose build --no-cache

docker-stop:
	docker compose  stop ${service}

docker-down:
	docker compose  down

down: docker-down

docker-build:
	docker compose  up --build -d ${service}

build: docker-build

docker-build-no-deps:
	docker-compose  up --build -d --no-deps ${service}

docker-log:
	docker compose  logs ${service}

php:
	docker compose  exec port-cli bash

queue-restart:
	docker compose  exec -u root -T php-fpm supervisorctl restart queue


nginx:
	docker-compose  exec nginx sh


dev:
	docker compose  exec -it port-cli  php artisan serve --host 0.0.0.0 --port 8000


start:
	composer install
	php artisan migrate --force
	nohup php artisan queue:work --daemon &
	php artisan serve --host $(HOST) --port $(PORT)
