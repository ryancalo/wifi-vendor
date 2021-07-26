build:
	docker-compose up --build -d

run:
	docker-compose up -d

stop:
	docker-compose down

.PHONY: build stop run