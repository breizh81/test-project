.PHONY: bash-root composer-install help install start
.DEFAULT_GOAL := help

DOCKER_CONTAINER_ID := $(shell docker ps -qf "name=^/php-symfony$$")

DOCKER=docker exec -ti $(DOCKER_CONTAINER_ID)
DOCKER_ROOT := docker exec -ti --user root $(DOCKER_CONTAINER_ID)

NO_COLOR=\033[39m
OK_COLOR=\033[92m
OK_STRING=$(OK_COLOR)[OK]$(OK_COLOR) 😀

bash-root: ## Enter container as root
	$(DOCKER_ROOT) zsh

composer-install:
	$(DOCKER_ROOT) composer install

cache-clear:
	$(DOCKER_ROOT) bin/console --env=dev cache:clear --no-warmup
	$(DOCKER_ROOT) bin/console --env=dev cache:warmup

phpunit:
	$(DOCKER_ROOT) bin/phpunit

create-mongo-schema:
	$(DOCKER_ROOT) bin/console doctrine:mongodb:schema:create

drop-mongo-schema:
	$(DOCKER_ROOT) bin/console doctrine:mongodb:schema:drop

populate-mongo-db:
	$(DOCKER_ROOT) bin/console app:add-article

install: composer-install ## Install dependencies

phpcs-fix-dry-run:
	$(DOCKER_ROOT) vendor/bin/php-cs-fixer fix  --dry-run

phpcs-fix:
	$(DOCKER_ROOT) vendor/bin/php-cs-fixer fix

start: ## Start the project
	COMPOSE_PROJECT_NAME="php-symfony" docker-compose -f docker-compose.yml up -d --build
	@echo "$(OK_STRING)" 'The web app should be accessible on http://localhost:8000'

stop: ## Stop the project
	COMPOSE_PROJECT_NAME="php-symfony" docker-compose -f docker-compose.yml down --remove-orphans

help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

restart: stop start