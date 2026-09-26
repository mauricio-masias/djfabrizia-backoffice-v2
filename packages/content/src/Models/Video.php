<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Database\Factories\VideoFactory;
use Djfabrizia\Content\Enums\ContentSource;
use Djfabrizia\Content\Models\Concerns\Publishable;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * A YouTube video.
 *
 * @property int $id
 * @property string $youtube_id
 * @property string $title
 * @property string|null $duration display duration, e.g. 2:04:13
 * @property ContentSource $source
 * @property int $sort
 * @property Carbon|null $source_missing_at
 * @property int|null $legacy_wp_id
 */
class Video extends Model
{
    /** @use HasFactory<VideoFactory> */
    use HasFactory, Publishable, UsesContentConnection;

    protected $fillable = [
        'youtube_id',
        'title',
        'duration',
        'source',
        'status',
        'published_at',
        'sort',
        'source_missing_at',
        'legacy_wp_id',
    ];

    protected $attributes = [
        'source' => 'manual',
        'status' => 'draft',
        'sort' => 0,
    ];

    protected function casts(): array
    {
        return [
            'source' => ContentSource::class,
            'sort' => 'integer',
            'source_missing_at' => 'datetime',
            'legacy_wp_id' => 'integer',
        ];
    }

    protected static function newFactory(): VideoFactory
    {
        return VideoFactory::new();
    }
}
