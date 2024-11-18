NETWORK:=larvel-project
CONTAINER_APP:=app
DOCKER_COMPOSE_COMMAND:=$(if $(shell command -v compose), docker compose, docker-compose)

# Initialize the application
init: network build start composer

# Run the application
run: network start composer

# Check if network exists, if not create it
network:
	@if docker network ls -q --filter name='^$(NETWORK)$$' | xargs -r false; then \
		case "$(NETWORK)" in \
		""|none|container:*|host|ns:*|private|slirp4netns*) true ;; \
		*) docker network create $(NETWORK) ;; \
		esac; \
	fi

# Run command in app container
exec:
	$(DOCKER_COMPOSE_COMMAND) exec $(CONTAINER_APP) $(cmd)

# Install composer dependencies
composer:
	$(DOCKER_COMPOSE_COMMAND) exec $(CONTAINER_APP) composer install

# Build local images
build:
	$(DOCKER_COMPOSE_COMMAND) build

# Start stopped containers
start:
	$(DOCKER_COMPOSE_COMMAND) up -d

# Stop all containers
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
