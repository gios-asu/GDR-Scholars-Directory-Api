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
http://server.app/api/v1/opportunities?limit=10&offset=10&orderBy=country
```


## Development Requirements

* PHP Version 7.0+
* phpunit

## Installation Instructions

* Install PHP version 7.0+

```shd
sudo apt-get install php5
```

Setup your application configuration settings by copying .env.example into .env and update the appropriate key values. Alternately, save the used application keys to the server environment variables, using your preferred method.
