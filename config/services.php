<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Resend, Postmark, AWS, and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    /*
    | Content syncs. Account names/IDs are editorial settings (Settings page);
    | only credentials live here. Mixcloud's public API needs none.
    */

    'mixcloud' => [
        'api_url' => 'https://api.mixcloud.com',
    ],

    'spotify' => [
        'client_id' => env('SPOTIFY_CLIENT_ID'),
        'client_secret' => env('SPOTIFY_CLIENT_SECRET'),
        // Spotify only serves playlists to a logged-in user: connect once with
        // "Connect Spotify" on the Settings page (token stored in the database).
        // SPOTIFY_REFRESH_TOKEN is an optional bootstrap fallback.
        'refresh_token' => env('SPOTIFY_REFRESH_TOKEN'),
        // Must exactly match a redirect URI registered in the Spotify dashboard.
        // Empty = the spotify.callback route URL.
        'redirect_uri' => env('SPOTIFY_REDIRECT_URI'),
        'accounts_url' => 'https://accounts.spotify.com',
        'api_url' => 'https://api.spotify.com/v1',
    ],

    'youtube' => [
        'api_key' => env('YOUTUBE_API_KEY'),
        'api_url' => 'https://www.googleapis.com/youtube/v3',
    ],

];
