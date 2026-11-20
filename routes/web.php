<?php

use Illuminate\Support\Facades\Route;

/*
 * The back office has no public pages: the root sends visitors and crawlers
 * to the public website. The panel lives at /admin.
 */
Route::get('/', fn () => redirect()->away((string) config('cms.public_site_url')));
