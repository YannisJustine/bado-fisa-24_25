build ?= 0

ifeq ($(build),1)
BUILD_FLAG = --build
else ifeq ($(build),true)
BUILD_FLAG = --build
else
BUILD_FLAG =
endif

dev:
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

clean:
	docker rm apache mysql redis || true
	docker rmi --force apache postgres:16 redis:7.4.1-alpine || true
	docker volume rm --force db_data || true
	