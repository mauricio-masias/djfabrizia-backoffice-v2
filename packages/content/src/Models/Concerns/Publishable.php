<?php

namespace Djfabrizia\Content\Models\Concerns;

use Djfabrizia\Content\Enums\PublishStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * Draft/published status with an optional publish date.
 *
 * @property PublishStatus $status
 * @property Carbon|null $published_at
 */
trait Publishable
{
    public function initializePublishable(): void
    {
        $this->mergeCasts([
            'status' => PublishStatus::class,
            'published_at' => 'datetime',
        ]);
    }

    /**
     * Published and not scheduled for a future date.
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where($this->qualifyColumn('status'), PublishStatus::Published->value)
            ->where(function (Builder $query): void {
                $query->whereNull($this->qualifyColumn('published_at'))
                    ->orWhere($this->qualifyColumn('published_at'), '<=', now());
            });
    }

    public function isPublished(): bool
    {
        return $this->status === PublishStatus::Published
            && ($this->published_at === null || $this->published_at->lte(now()));
    }
}
