.PHONY: build up down restart logs shell clean

build:
	docker-compose build

up:
	docker-compose up -d
	@make links

links:
	@echo "App : http://localhost:8000"

down:
	docker-compose down

restart: down up

logs:
	docker-compose logs -f

shell:
	docker-compose exec app /bin/bash

clean:
	docker-compose down --rmi all -v
