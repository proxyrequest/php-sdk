COMPOSER_BIN ?= composer
SOURCE ?= ../../../papaproxy/api/openapi.yml

.PHONY: install generate generate-check sync-openapi test analyse format format-check quality

install:
	$(COMPOSER_BIN) install

generate:
	./scripts/generate.sh

generate-check:
	./scripts/check-generated.sh

sync-openapi:
	php scripts/sync-openapi.php "$(SOURCE)"

test:
	$(COMPOSER_BIN) test

analyse:
	$(COMPOSER_BIN) analyse

format:
	$(COMPOSER_BIN) format

format-check:
	$(COMPOSER_BIN) format:check

quality:
	$(COMPOSER_BIN) validate --strict
	$(COMPOSER_BIN) quality
	$(COMPOSER_BIN) audit
