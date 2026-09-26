<?php

return [
    /*
    |--------------------------------------------------------------------------
    | First admin user
    |--------------------------------------------------------------------------
    |
    | Created (or updated) by AdminUserSeeder. Leave the email empty to skip it.
    |
    */
    'admin' => [
        'name' => env('CMS_ADMIN_NAME', 'Admin'),
        'email' => env('CMS_ADMIN_EMAIL'),
        'password' => env('CMS_ADMIN_PASSWORD'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Endpoint
    |--------------------------------------------------------------------------
    |
    | The API app that serves the public JSON. The back office asks it to
    | rebuild its cache after edits, and asks it for draft previews.
    |
    */
    'endpoint' => [
        'url' => env('ENDPOINT_URL', 'http://djendpoint:8080'),
        'warm_token' => env('ENDPOINT_WARM_TOKEN'),
        'preview_token' => env('ENDPOINT_PREVIEW_TOKEN'),
    ],

    /*
    |--------------------------------------------------------------------------
    | WordPress import
    |--------------------------------------------------------------------------
    |
    | Where the WordPress uploads folder is mounted (read-only), and the CFDB7
    | form that held booking requests.
    |
    */
    'import' => [
        'uploads_path' => env('WP_UPLOADS_PATH', '/mnt/wp-uploads'),
        'booking_form_id' => 986,
        'mixcloud_url' => 'https://www.mixcloud.com',
    ],
];
