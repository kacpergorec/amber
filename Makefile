NETWORK:=amber-cms
CONTAINER_APP:=app
CONTAINER_DB:=pgsql
DOCKER_COMPOSE_COMMAND:=$(if $(shell command -v compose), docker compose, docker-compose)

# Initialize the application
init: network build start composer npm-install build-front composer migrate-refresh seed

# Run the application
run: network start composer npm-install

# Check if network exists, if not create it
network:
	@if docker network ls -q --filter name='^$(NETWORK)$$' | xargs -r false; then \
		case "$(NETWORK)" in \
		""|none|container:*|host|ns:*|private|slirp4netns*) true ;; \
		*) docker network create $(NETWORK) ;; \
		esac; \
	fi

composer:
	$(DOCKER_COMPOSE_COMMAND) exec $(CONTAINER_APP) composer install

build:
	$(DOCKER_COMPOSE_COMMAND) build

start:
	$(DOCKER_COMPOSE_COMMAND) up -d

stop:
	$(DOCKER_COMPOSE_COMMAND) down

npm-install:
	$(DOCKER_COMPOSE_COMMAND) exec $(CONTAINER_APP) npm install

npm-run-dev:
	$(DOCKER_COMPOSE_COMMAND) exec $(CONTAINER_APP) npm run dev

build-front:
	$(DOCKER_COMPOSE_COMMAND) exec $(CONTAINER_APP) npm run build

prettier:
	$(DOCKER_COMPOSE_COMMAND) exec $(CONTAINER_APP) npm run prettier

migrate-refresh:
	$(DOCKER_COMPOSE_COMMAND) exec $(CONTAINER_APP) php artisan migrate:refresh

migrate:
	$(DOCKER_COMPOSE_COMMAND) exec $(CONTAINER_APP) php artisan migrate

seed:
	$(DOCKER_COMPOSE_COMMAND) exec $(CONTAINER_APP) php artisan db:seed

clear:
	$(DOCKER_COMPOSE_COMMAND) exec $(CONTAINER_APP) php artisan cache:clear && php artisan config:clear && php artisan view:clear

phpstan:
	$(DOCKER_COMPOSE_COMMAND) exec $(CONTAINER_APP) ./vendor/bin/phpstan analyse

run-tests:
	$(DOCKER_COMPOSE_COMMAND) exec $(CONTAINER_APP) php artisan test --coverage --env=testing

create-testing-db:
	@if [ -f .env.testing ]; then \
		$(DOCKER_COMPOSE_COMMAND) exec $(CONTAINER_DB) psql -U $$(grep DB_USERNAME .env | cut -d '=' -f2) -c "CREATE DATABASE $$(grep DB_DATABASE .env.testing | cut -d '=' -f2)" || true; \
	fi
	$(DOCKER_COMPOSE_COMMAND) exec $(CONTAINER_APP) php artisan migrate --env=testing
