init:
	docker-compose up -d --build --remove-orphans

install:
	composer install

validate:
	composer validate

brain-games:
	./bin/brain-games
