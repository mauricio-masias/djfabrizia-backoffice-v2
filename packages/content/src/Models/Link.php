<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Database\Factories\LinkFactory;
use Djfabrizia\Content\Enums\LinkMedia;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * A linktree link. It can appear in several sections.
 *
 * @property int $id
 * @property LinkMedia $media
 * @property string|null $description
 * @property int|null $image_media_id
 * @property string|null $url free URL ("custom") or user handle ("<platform>-custom")
 * @property int $sort
 * @property string|null $legacy_key
 */
class Link extends Model
{
    /** @use HasFactory<LinkFactory> */
    use HasFactory, UsesContentConnection;

    protected $fillable = [
        'media',
        'description',
        'image_media_id',
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
            'media' => LinkMedia::class,
            'sort' => 'integer',
        ];
    }

    protected static function newFactory(): LinkFactory
    {
        return LinkFactory::new();
    }

    /**
     * @return BelongsTo<Media, $this>
     */
    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_media_id');
    }

    /**
     * @return BelongsToMany<LinkSection, $this>
     */
    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(LinkSection::class);
    }
}
