#!/usr/bin/env make

include .env

.DEFAULT_GOAL := help
.PHONY: help

ENV_FILE = ".env"
COMPOSE_FILE ?= "docker-compose.yml"
TEST_COMPOSE_FILE ?= "docker-compose.testing.yml"
TEST_CONTAINER ?= "php-testing"
VOLUMES = $(docker volume ls -q -f name=$(APP_NAME))
DOCKER_COMPOSE = $(if $(shell which docker-compose) "$(shell which docker) compose", $(shell which docker-compose))

KEYS := exec

define LOOP_BODY
	ifneq ($$(filter $$(KEYS),$(v)),)
		RUN_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
	endif
endef

$(foreach v,$(firstword $(MAKECMDGOALS)),$(eval $(LOOP_BODY)))

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

purge-volumes:
	docker volume rm $(VOLUMES)

start: ## start-clear - Run the project at clear point.
	$(DOCKER_COMPOSE) --env-file $(ENV_FILE) -f $(COMPOSE_FILE) -p $(APP_NAME) stop
	$(DOCKER_COMPOSE) --env-file $(ENV_FILE) -f $(COMPOSE_FILE) -p $(APP_NAME) rm -f
	$(DOCKER_COMPOSE) --env-file $(ENV_FILE) -f $(COMPOSE_FILE) -p $(APP_NAME) up -d --build --force-recreate

stop: ## stop - Stop the project.
	$(DOCKER_COMPOSE) --env-file $(ENV_FILE) -f $(COMPOSE_FILE) -p $(APP_NAME) stop
	$(DOCKER_COMPOSE) --env-file $(ENV_FILE) -f $(COMPOSE_FILE) -p $(APP_NAME) rm -f

exec: ## exec - Exec command in container by name.
	$(DOCKER_COMPOSE) --env-file $(ENV_FILE) -p $(APP_NAME) exec $(RUN_ARGS)

test: ## test - start tests.
	$(DOCKER_COMPOSE) --env-file $(ENV_FILE) -f $(COMPOSE_FILE) -p $(APP_NAME) stop
	$(DOCKER_COMPOSE) --env-file $(ENV_FILE) -f $(COMPOSE_FILE) -p $(APP_NAME) rm -f
	$(DOCKER_COMPOSE) --env-file $(ENV_FILE) -f $(TEST_COMPOSE_FILE) -p $(APP_NAME) build
	$(DOCKER_COMPOSE) --env-file $(ENV_FILE) -f $(TEST_COMPOSE_FILE) -p $(APP_NAME) run --rm $(TEST_CONTAINER) composer test

%:
@:
