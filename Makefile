MAKEFLAGS += --no-print-directory

build:
	docker-compose build

up:
	docker-compose up -d
	@make vendor
	@make links

links:
	@echo "---- App : http://localhost:8000 ----"

vendor:	composer.lock
	docker-compose exec app composer install

down:
	docker-compose down

logs:
	docker-compose logs -f

shell:
	docker-compose exec app /bin/bash

clean:
	docker-compose down --rmi all -v
