<?php

namespace App\Console\Commands;

use App\Publishing\ContentTopics;
use App\Publishing\PendingWarmTopics;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Page;
use Djfabrizia\Content\Models\Playlist;
use Djfabrizia\Content\Models\Release;
use Djfabrizia\Content\Models\Setting;
use Djfabrizia\Content\Models\Video;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * Content scheduled for a future date appears when that date passes; nothing
 * is saved at that moment, so this every-minute task queues its topics.
 */
class WarmScheduledContent extends Command
{
    protected $signature = 'endpoint:warm-scheduled';

    protected $description = 'Queue a cache rebuild for content whose publish date has just passed';

    private const PUBLISHABLE = [Page::class, Mix::class, Release::class, Playlist::class, Video::class];

    public function handle(PendingWarmTopics $pending): int
    {
        $since = Carbon::parse((string) Setting::value('publishing', 'scheduled_checked_at', now()->subHour()->toIso8601String()));
        $now = now();
        $topics = [];

        foreach (self::PUBLISHABLE as $model) {
            $model::query()->published()->whereBetween('published_at', [$since, $now])
                ->each(function ($item) use (&$topics): void {
                    array_push($topics, ...ContentTopics::for($item));
                });
        }

        $pending->add(array_values(array_unique($topics)));
        Setting::put('publishing', 'scheduled_checked_at', $now->toIso8601String());

        $this->line(count(array_unique($topics)).' topic(s) queued.');

        return self::SUCCESS;
    }
}
