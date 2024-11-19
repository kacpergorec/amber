NETWORK:=amber-cms
CONTAINER_APP:=app
DOCKER_COMPOSE_COMMAND:=$(if $(shell command -v compose), docker compose, docker-compose)

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

run-tests:
	$(DOCKER_COMPOSE_COMMAND) exec $(CONTAINER_APP) php artisan test --coverage
