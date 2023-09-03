init:
	docker-compose up -d --build --remove-orphans

install:
	composer install

validate:
	composer validate

refresh:
	composer dump-autoload

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin

brain-games:
	./bin/brain-games

brain-even:
	./bin/brain-even

brain-calc:
	./bin/brain-calc

brain-gcd:
	./bin/brain-gcd