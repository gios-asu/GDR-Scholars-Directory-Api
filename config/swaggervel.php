<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Absolute path to location where parsed swagger annotations will be stored
      |--------------------------------------------------------------------------
    */
    'doc-dir' => storage_path('docs'),

    /*
      |--------------------------------------------------------------------------
      | Relative path to access parsed swagger annotations.
      |--------------------------------------------------------------------------
    */
    'doc-route' => 'docs',

    /*
      |--------------------------------------------------------------------------
      | Relative path to access swagger ui.
      |--------------------------------------------------------------------------
    */
    'api-docs-route' => 'api/docs',

    /*
      |--------------------------------------------------------------------------
      | Absolute path to directory containing the swagger annotations are stored.
      |--------------------------------------------------------------------------
    */
    'app-dir' => 'app',

    /*
      |--------------------------------------------------------------------------
      | Absolute path to directories that you would like to exclude from swagger generation
      |--------------------------------------------------------------------------
    */
    'excludes' => [
    ],

    /*
      |--------------------------------------------------------------------------
      | If set to true, automatically regenerates the definitions everytime you open the UI
      |--------------------------------------------------------------------------
    */
    "auto-generate" => true,

    /*
      |--------------------------------------------------------------------------
      | ...
      |--------------------------------------------------------------------------
    */
    "api-key" => "auth_token",

    /*
      |--------------------------------------------------------------------------
      | Edit to trust the proxy's ip address - needed for AWS Load Balancer
      |--------------------------------------------------------------------------
    */
    'behind-reverse-proxy' => false,

    /*
      |--------------------------------------------------------------------------
      | Uncomment to add response headers when swagger is generated
      |--------------------------------------------------------------------------
    */
    'viewHeaders' => [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, POST',
        'Access-Control-Allow-Headers' => 'X-Requested-With',
    ],

    /*
      |--------------------------------------------------------------------------
      | Uncomment to add request headers when swagger-ui performs requests
      |--------------------------------------------------------------------------
    */
    "requestHeaders" => [
    ],
];
