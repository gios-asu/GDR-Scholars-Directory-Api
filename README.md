GDR Scholars Catalog - API Server
====================================

This is a Laravel PHP REST API server for interfacing with the GDR Scholars Frontend Application.

Laravel is a powerful and flexible web framework, highly configurable and extendable using addons from the community. THis version of Laravel has been scaffolded using [InfyOm Labs Laravel Generator](https://github.com/InfyOmLabs/laravel-generator). Laravel has been extended and reorganized to offer:

* REST API with versioning and db translations
* Database Repository pattern
* Swagger API documentation

The GDR Scholars Catalog is a basic DataTables interface for browsing USAID Fellowship opportunities. The API server provides REST endpoints to:

* GET  /api/v1/opportunities          - Retrieve catalog items. Pagination and sort is available.
* GET  /api/v1/opportunities/{itemId} - Show details on a specific listing.
* POST /api/v1/opportunities/apply    - Submit application for a specific listing.
* POST /uploads/submit                - Standalone file upload endpoint for ajax file uploads.
* POST /uploads/delete                - Delete a file, given user has permission (Not functional).

Pagination and sort is available on GET:/api/v1/opportunities. For example, to retrieve 10 results per page and begin with the results on the second page, sorted by country:
```
http://localhost/api/v1/opportunities?limit=10&offset=10&orderBy=country
```


## Development Requirements

* Docker CE 17.05+

## Development/Testing Instructions

### 1. Make sure Docker is running on your computer

```shd
docker --version
```

Setup your application configuration settings by copying .env.example into .env and update the appropriate key values. The default values in .env.example are suitable for the local dev environment in Docker.

### 2. Install composer dependencies and prep project to be deployed in Docker:

```
sh composer-install-development.sh
```

### 3. Build the dev images for Docker:

```
docker-compose build
```

### 4. Launch the API containers:

```
docker-compose up -d
```

### 5. Set up database for development

If you want to seed to the database with fake data:

```
docker exec apigdrscholarsgiosasuedu_api-gdrscholars-app_1 php artisan migrate --seed
```

If you only want the database tables to be built and left empty:

```
docker exec apigdrscholarsgiosasuedu_api-gdrscholars-app_1 php artisan migrate
```

### 6. Access API using provided endpoints

The api is now served at: http://localhost and the endpoints listed above. (e.g. http://localhost/api/v1/opportunities)


## Deploy to production server(s)

### 1. Make sure Docker is running on your computer

```shd
docker --version
```

Setup the application configuration settings by copying .env.example into .env and update the appropriate key values for production.

### 2. Install composer dependencies and prep project to be deployed in Docker:

```
sh composer-install-production.sh
```

### 3. Build the production images and push to AWS registry (ECR):

Sign in to AWS ECR service (You must already have set up AWS CLI and the AWS credentials; sign-in expires after 12 hours):

```
aws ecr get-login --profile gios-docker --no-include-email --region us-west-2
```

Build images and push to ECR:
```
sh docker-build-images.sh
```

Updated images can be installed into running containers through the Rancher management dashboard.
