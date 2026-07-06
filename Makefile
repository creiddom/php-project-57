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

lint:
	composer exec --verbose phpcs -- --standard=PSR12 app routes tests

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 app routes tests

test:
	php artisan test

test-coverage:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

build:
	npm ci && npm run build
