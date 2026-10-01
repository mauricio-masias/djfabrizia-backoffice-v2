<?php

namespace App\Listeners;

use App\Events\ContentChanged;
use App\Publishing\EndpointWarmer;
use App\Publishing\PendingWarmTopics;
use Illuminate\Contracts\Foundation\Application;

/**
 * Collects changed topics. In a web request (an editor saving) they are sent
 * once, right after the response; everything else (syncs, console, retries)
 * is sent by the every-minute `endpoint:warm` task.
 */
class QueueEndpointWarm
{
    private static bool $flushRegistered = false;

    public function __construct(
        private readonly PendingWarmTopics $pending,
        private readonly Application $app,
    ) {}

    public function handle(ContentChanged $event): void
    {
        $this->pending->add($event->topics);

        if ($this->app->runningInConsole() || self::$flushRegistered) {
            return;
        }

        self::$flushRegistered = true;

        $this->app->terminating(function (): void {
            self::$flushRegistered = false;
            $this->app->make(EndpointWarmer::class)->flush();
        });
    }
}
