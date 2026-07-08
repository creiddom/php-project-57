PORT ?= 8000

start:
	php artisan serve --host=0.0.0.0 --port=$(PORT)

migrate:
	php artisan migrate:fresh --force --seed

install:
	composer install

setup:
	cp -n .env.example .env || true
	composer install
	php artisan key:generate
	npm ci
	npm run build

lint: lint-phpcs lint-phpstan

lint-phpcs: vendor/bin/phpcs
	@echo "Проверка стиля кода (phpcs)..."
	@php vendor/bin/phpcs --standard=PSR12 app routes tests
	@echo "phpcs: OK"

lint-phpstan: vendor/bin/phpstan
	@echo "Статический анализ (phpstan)..."
	@php vendor/bin/phpstan analyse -c phpstan.neon --memory-limit=256M
	@echo "phpstan: OK"

lint-fix: vendor/bin/phpcbf
	@echo "Исправление стиля кода (phpcbf)..."
	@php vendor/bin/phpcbf --standard=PSR12 app routes tests
	@echo "phpcbf: OK"

vendor/bin/phpcs vendor/bin/phpcbf vendor/bin/phpstan: composer.lock
	composer install

test:
	php artisan test

test-coverage:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

build:
	npm ci && npm run build
