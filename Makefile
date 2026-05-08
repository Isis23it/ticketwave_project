.PHONY: setup up down logs shell migrate fresh clear artisan composer tools

setup:
	docker compose up -d --build
	docker compose exec app composer install
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan migrate
	docker compose exec app php artisan db:seed
	docker compose exec app php artisan storage:link

up:
	docker compose up -d

down:
	docker compose down

logs:
	docker compose logs -f

shell:
	docker compose exec app bash

migrate:
	docker compose exec app php artisan migrate

fresh:
	docker compose exec app php artisan migrate:fresh --seed

clear:
	docker compose exec app php artisan config:clear
	docker compose exec app php artisan cache:clear
	docker compose exec app php artisan view:clear
	docker compose exec app php artisan route:clear

artisan:
	docker compose exec app php artisan $(cmd)

composer:
	docker compose exec app composer $(cmd)