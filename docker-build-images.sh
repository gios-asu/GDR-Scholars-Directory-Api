#!/bin/bash

docker-compose build

docker tag api-gdrscholars-app:latest 463057111838.dkr.ecr.us-west-2.amazonaws.com/api-gdrscholars-app:latest
docker push 463057111838.dkr.ecr.us-west-2.amazonaws.com/api-gdrscholars-app:latest

docker tag api-gdrscholars-web:latest 463057111838.dkr.ecr.us-west-2.amazonaws.com/api-gdrscholars-web:latest
docker push 463057111838.dkr.ecr.us-west-2.amazonaws.com/api-gdrscholars-web:latest
