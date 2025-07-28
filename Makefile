.PHONY: up down build test logs

up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose build

logs:
	docker-compose logs -f

test-user:
	docker-compose exec user-service ./vendor/bin/phpunit --testsuite=Unit

test-appointment:
	docker-compose exec appointment-service ./vendor/bin/phpunit --testsuite=Unit
