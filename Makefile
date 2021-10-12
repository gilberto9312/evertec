docker-build:
	docker-compose -f docker-compose.yaml --env-file ./docker/api.env up -d --build
docker-start:
	docker-compose -f docker-compose.yaml --env-file ./docker/api.env start
docker-logs:
	docker-compose -f docker-compose.yaml logs --follow apiservices_new
docker-stop:
	docker-compose -f docker-compose.yaml stop