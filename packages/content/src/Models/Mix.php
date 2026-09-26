<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Blocks\ReferenceKind;
use Djfabrizia\Content\Database\Factories\MixFactory;
use Djfabrizia\Content\Enums\ContentSource;
use Djfabrizia\Content\Models\Concerns\Publishable;
use Djfabrizia\Content\Models\Concerns\ReferencedByPages;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * A Mixcloud show (or a manual mix).
 *
 * @property int $id
 * @property string $title
 * @property string|null $short_name
 * @property string $url Mixcloud path, e.g. /djfabrizia/some-show/
 * @property string|null $image_url
 * @property string|null $image_small_url
 * @property Carbon|null $released_at
 * @property string|null $duration display duration, e.g. 64:56
 * @property list<string>|null $source_tags raw upstream tags
 * @property ContentSource $source
 * @property string|null $external_id
 * @property int $sort
 * @property Carbon|null $source_missing_at
 * @property int|null $legacy_wp_id
 */
class Mix extends Model
{
    /** @use HasFactory<MixFactory> */
    use HasFactory, Publishable, ReferencedByPages, UsesContentConnection;

    protected $fillable = [
        'title',
        'short_name',
        'url',
        'image_url',
        'image_small_url',
        'released_at',
        'duration',
        'source_tags',
        'source',
        'external_id',
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
            'released_at' => 'datetime',
            'source_tags' => 'array',
            'source' => ContentSource::class,
            'sort' => 'integer',
            'source_missing_at' => 'datetime',
            'legacy_wp_id' => 'integer',
        ];
    }

    public static function referenceKind(): ReferenceKind
    {
        return ReferenceKind::Mixes;
    }

    protected static function newFactory(): MixFactory
    {
        return MixFactory::new();
    }

    /**
     * @return BelongsToMany<Genre, $this>
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }
}
