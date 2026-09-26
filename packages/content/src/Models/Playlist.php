<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Database\Factories\PlaylistFactory;
use Djfabrizia\Content\Enums\ContentSource;
use Djfabrizia\Content\Models\Concerns\Publishable;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * A Spotify playlist.
 *
 * @property int $id
 * @property string $title
 * @property string|null $short_name
 * @property string $url
 * @property string|null $uri
 * @property string|null $image_url
 * @property string|null $owner_url
 * @property string|null $owner_id
 * @property int|null $tracks_total
 * @property bool $collaborative
 * @property ContentSource $source
 * @property string|null $external_id
 * @property int $sort
 * @property Carbon|null $source_missing_at
 * @property int|null $legacy_wp_id
 */
class Playlist extends Model
{
    /** @use HasFactory<PlaylistFactory> */
    use HasFactory, Publishable, UsesContentConnection;

    protected $fillable = [
        'title',
        'short_name',
        'url',
        'uri',
        'image_url',
        'owner_url',
        'owner_id',
        'tracks_total',
        'collaborative',
        'source',
        'external_id',
        'status',
        'published_at',
        'sort',
        'source_missing_at',
        'legacy_wp_id',
    ];

    protected $attributes = [
        'collaborative' => false,
        'source' => 'manual',
        'status' => 'draft',
        'sort' => 0,
    ];

    protected function casts(): array
    {
        return [
            'tracks_total' => 'integer',
            'collaborative' => 'boolean',
            'source' => ContentSource::class,
            'sort' => 'integer',
            'source_missing_at' => 'datetime',
            'legacy_wp_id' => 'integer',
        ];
    }

    protected static function newFactory(): PlaylistFactory
    {
        return PlaylistFactory::new();
    }
}
