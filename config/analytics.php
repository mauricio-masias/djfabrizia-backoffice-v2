<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Google Analytics 4 property
    |--------------------------------------------------------------------------
    |
    | "google" reads the GA4 Data API. "fake" returns deterministic sample
    | data and is opt-in only, never a silent fallback, so nobody mistakes
    | sample numbers for real traffic.
    |
    | The property id is the numeric id (Admin -> Property Settings), NOT the
    | "G-XXXX" measurement id.
    |
    */

    'driver' => env('ANALYTICS_DRIVER', 'google'),

    'property_id' => env('GA4_PROPERTY_ID'),

    /*
    | Path to the service account JSON key. Relative paths are resolved from
    | the application root by AnalyticsServiceProvider. The default location
    | is git-ignored and uploaded to the server by hand.
    */
    'credentials_path' => env(
        'GA4_CREDENTIALS_PATH',
        'storage/app/private/analytics/ga4-service-account.json',
    ),

    /*
    |--------------------------------------------------------------------------
    | Reporting calendar
    |--------------------------------------------------------------------------
    |
    | GA4 buckets data using the property timezone. Everything the dashboard
    | reports is anchored to this timezone, so "today" means the same thing
    | in every widget. Keep it in sync with the GA4 property setting.
    |
    */

    'timezone' => env('ANALYTICS_TIMEZONE', 'Europe/London'),

    /*
    | Lower bound for "all time" queries. GA4 rejects dates before 2015-08-14.
    */
    'earliest_date' => env('ANALYTICS_EARLIEST_DATE', '2020-01-01'),

    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | The Data API allows a limited number of tokens per property per day.
    | Periods that include recent days still move, so they expire fast;
    | closed periods never change and are held far longer. A null store uses
    | the default cache store (the database driver in production).
    |
    */

    'cache' => [
        'store' => env('ANALYTICS_CACHE_STORE'),
        'prefix' => 'analytics',
        'live_ttl' => (int) env('ANALYTICS_LIVE_TTL', 900),
        'historical_ttl' => (int) env('ANALYTICS_HISTORICAL_TTL', 43200),
    ],

];
