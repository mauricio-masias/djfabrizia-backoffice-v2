<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Content database connection
    |--------------------------------------------------------------------------
    |
    | The connection the shared models read from. The back office owns the
    | schema and uses its default connection (null); the endpoint points this
    | at its read-only "cms" connection.
    |
    */
    'connection' => env('CONTENT_DB_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | Public media base URL
    |--------------------------------------------------------------------------
    |
    | Absolute base URL for files on the back office "public" disk, e.g.
    | https://backoffice.example.com/storage. When null, the disk's own URL is
    | used (correct inside the back office itself).
    |
    */
    'media_url' => env('CMS_MEDIA_URL'),
];
