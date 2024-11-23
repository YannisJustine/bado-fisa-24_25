build ?= 0

ifeq ($(build),1)
BUILD_FLAG = --build
else ifeq ($(build),true)
BUILD_FLAG = --build
else
BUILD_FLAG =
endif

all: prod

dev:
	chmod +x ./docker-entrypoint-dev.sh
	docker compose --env-file ./src/.env -f docker-compose.yml -f docker-compose.dev.yml up -d $(BUILD_FLAG)

prod:
	docker compose --env-file ./src/.env -f docker-compose.yml -f docker-compose.prod.yml up -d $(BUILD_FLAG)

stop:
	docker compose --env-file ./src/.env down

migrate:
	docker exec -it apache php artisan migrate

seed:
	docker exec -it apache php artisan db:seed

clean-db:
	docker exec -it apache php artisan db:wipe

stop-all:
	docker stop `docker ps -a -q`

connect-apache:
	docker exec -it apache /bin/bash

connect-postgres:
	docker exec -it postgres /bin/bash

connect-redis:
	docker exec -it redis redis-cli

clean:
	docker rm php:8.2-apache postgres redis || true
	docker rmi --force php:8.2-apache postgres:16 redis:7.4.1-alpine || true
	docker volume rm --force db_data || true
	