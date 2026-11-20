<?php

use App\Http\Controllers\SpotifyAuthController;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

/*
 * The back office has no public pages: the root sends visitors and crawlers
 * to the public website. The panel lives at /admin.
 */
Route::get('/', fn () => redirect()->away((string) config('cms.public_site_url')));

/*
 * Spotify login for the playlist sync. Only signed-in admins (same check as
 * the panel: guests go to the login, non-admins get a 403).
 */
Route::middleware(['web', Authenticate::class])->prefix('admin/spotify')->group(function (): void {
    Route::get('connect', [SpotifyAuthController::class, 'connect'])->name('spotify.connect');
    Route::get('callback', [SpotifyAuthController::class, 'callback'])->name('spotify.callback');
});
