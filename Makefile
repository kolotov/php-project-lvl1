init:
	docker-compose up -d --build --remove-orphans
	make install

install:
	docker-compose run --rm composer install

validate:
	docker-compose run --rm composer validate

refresh:
	docker-compose run --rm composer dump-autoload

lint:
	docker-compose run --rm composer exec --verbose phpcs -- --standard=PSR12 src bin

brain-games:
	./bin/brain-games

brain-even:
	./bin/brain-even

brain-calc:
	./bin/brain-calc

brain-gcd:
	./bin/brain-gcd

brain-progression:
	./bin/brain-progression

brain-prime:
	./bin/brain-prime