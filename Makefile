dev:
	docker compose --env-file ./src/.env -f docker-compose.yml -f docker-compose.dev.yml up -d --build 

prod:
	docker compose --env-file ./src/.env -f docker-compose.yml -f docker-compose.prod.yml up -d

stop:
	docker compose --env-file ./src/.env down

migrate:
	docker exec -it apache php artisan migrate

stop-all:
	docker stop `docker ps -a -q`

clean:
	docker rm apache mysql redis || true
	docker rmi --force apache postgres:16 redis:7.4.1-alpine || true
	docker volume rm --force db_data || true