build:
	docker-compose build
	docker-compose exec app bash -c "cd /var/www/html/src && composer install"

run:
	docker-compose up -d

migrate:
	docker-compose exec app bash -c "cd /var/www/html/src && php artisan migrate"

env:
	docker-compose exec app bash -c "cd /var/www/html/src && cp .env.example .env"

generate-key:
	docker-compose exec app bash -c "cd /var/www/html/src && php artisan key:generate"

start: build run

stop:
	docker-compose down

logs:
	docker-compose logs -f app

deploy: start env migrate generate-key
