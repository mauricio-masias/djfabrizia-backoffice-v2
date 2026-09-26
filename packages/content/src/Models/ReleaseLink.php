<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Database\Factories\ReleaseLinkFactory;
use Djfabrizia\Content\Enums\ReleasePlatform;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $release_id
 * @property ReleasePlatform $platform
 * @property string|null $label
 * @property string $url
 * @property int $sort
 * @property string|null $legacy_key
 */
class ReleaseLink extends Model
{
    /** @use HasFactory<ReleaseLinkFactory> */
    use HasFactory, UsesContentConnection;

    protected $fillable = [
        'release_id',
        'platform',
        'label',
        'url',
        'sort',
        'legacy_key',
    ];

    protected $attributes = [
        'sort' => 0,
    ];

    protected function casts(): array
    {
        return [
            'platform' => ReleasePlatform::class,
            'sort' => 'integer',
        ];
    }

    protected static function newFactory(): ReleaseLinkFactory
    {
        return ReleaseLinkFactory::new();
    }

    /**
     * @return BelongsTo<Release, $this>
     */
    public function release(): BelongsTo
    {
        return $this->belongsTo(Release::class);
    }
}
