<?php

namespace App\Observers;

use App\Events\ContentChanged;
use App\Publishing\ContentTopics;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Database\Eloquent\Model;

/**
 * Turns saved or deleted content into a ContentChanged event (after the
 * transaction commits), so the public API is rebuilt for it.
 */
class PublishesToEndpoint implements ShouldHandleEventsAfterCommit
{
    public function saved(Model $model): void
    {
        $this->changed($model);
    }

    public function deleted(Model $model): void
    {
        $this->changed($model);
    }

    private function changed(Model $model): void
    {
        $topics = ContentTopics::for($model);

        if ($topics !== []) {
            ContentChanged::dispatch($topics);
        }
    }
}
