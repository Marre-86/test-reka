go:
	php artisan serve
railway: livewire migrate seed storage-link start
PORT ?= 6985
start:
	PHP_CLI_SERVER_WORKERS=5 php -S 0.0.0.0:$(PORT)  -t public
livewire:
	php artisan vendor:publish --force --tag=livewire:assets
migrate:
	php artisan migrate:fresh --force
	php artisan migrate --force
seed:
	php artisan db:seed --force
storage-link:
	php artisan storage:link 
install:
	composer install
validate:
	composer validate
lint:
	composer exec --verbose phpcs -- --standard=PSR12 app public routes tests
test:
	php artisan test --coverage --min=80
