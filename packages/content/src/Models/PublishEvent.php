<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Enums\PublishEventStatus;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Audit row for one cache warm request sent to the endpoint.
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $subject_type
 * @property int|null $subject_id
 * @property list<string> $targets
 * @property PublishEventStatus $status
 * @property array<string, mixed>|null $response
 */
class PublishEvent extends Model
{
    use UsesContentConnection;

    protected $fillable = [
        'user_id',
        'subject_type',
        'subject_id',
        'targets',
        'status',
        'response',
    ];

    protected $attributes = [
        'status' => 'queued',
    ];

    protected function casts(): array
    {
        return [
            'targets' => 'array',
            'status' => PublishEventStatus::class,
            'response' => 'array',
        ];
    }

    /**
     * @return MorphTo<Model, $this>
     */
    public function subject(): MorphTo
    {
        return $this->morphTo();
    }
}
