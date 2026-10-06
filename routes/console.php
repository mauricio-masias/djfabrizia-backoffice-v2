<?php

use App\Jobs\SyncProviderJob;
use Djfabrizia\Content\Enums\SyncProvider;
use Illuminate\Support\Facades\Schedule;

/*
|--------------------------------------------------------------------------
| Scheduler
|--------------------------------------------------------------------------
|
| Production is shared hosting with no daemons: a single cron entry runs
| `php artisan schedule:run` every minute (see DEPLOYMENT.md). Queued jobs
| (image variants, cache warms, syncs) live in the `jobs` table and are
| drained here by a short-lived worker that stops when the queue is empty
| and never outlives the minute. withoutOverlapping() skips a minute while
| the previous worker is still busy.
|
*/

Schedule::command('queue:work --stop-when-empty --max-time=55 --tries=3 --timeout=120')
    ->everyMinute()
    ->withoutOverlapping(10)
    ->runInBackground() // or a 55 s drain delays every other task of that minute
    ->name('queue-drain');

// Daily content syncs (queued, then run by the queue drain above).
Schedule::job(new SyncProviderJob(SyncProvider::Mixcloud))->dailyAt('03:00')->name('sync-mixcloud');
Schedule::job(new SyncProviderJob(SyncProvider::Spotify))->dailyAt('03:10')->name('sync-spotify');
Schedule::job(new SyncProviderJob(SyncProvider::Youtube))->dailyAt('03:20')->name('sync-youtube');

// Public API cache: send pending content changes (saves send them at once;
// this retries anything left over, e.g. after a sync), and pick up content
// whose scheduled publish date has just passed, so it goes live on the minute.
Schedule::command('endpoint:warm')->everyMinute()->withoutOverlapping(5)->name('endpoint-warm');
Schedule::command('endpoint:warm-scheduled')->everyMinute()->withoutOverlapping(5)->name('endpoint-warm-scheduled');
