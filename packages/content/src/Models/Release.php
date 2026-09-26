<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Blocks\ReferenceKind;
use Djfabrizia\Content\Database\Factories\ReleaseFactory;
use Djfabrizia\Content\Enums\CoverSource;
use Djfabrizia\Content\Models\Concerns\Publishable;
use Djfabrizia\Content\Models\Concerns\ReferencedByPages;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * A music release with its store links.
 *
 * @property int $id
 * @property string $title
 * @property CoverSource $cover_source
 * @property int|null $cover_media_id
 * @property string|null $cover_external_url
 * @property int|null $track_media_id
 * @property string|null $duration
 * @property string|null $bpm
 * @property int|null $record_label_id
 * @property int|null $primary_genre_id
 * @property int|null $year
 * @property string|null $description
 * @property string|null $legacy_description raw WordPress "Style | Label | Year"
 * @property int $sort
 * @property int|null $legacy_wp_id
 */
class Release extends Model
{
    /** @use HasFactory<ReleaseFactory> */
    use HasFactory, Publishable, ReferencedByPages, UsesContentConnection;

    protected $fillable = [
        'title',
        'cover_source',
        'cover_media_id',
        'cover_external_url',
        'track_media_id',
        'duration',
        'bpm',
        'record_label_id',
        'primary_genre_id',
        'year',
        'description',
        'legacy_description',
        'status',
        'published_at',
        'sort',
        'legacy_wp_id',
    ];

    protected $attributes = [
        'cover_source' => 'local',
        'status' => 'draft',
        'sort' => 0,
    ];

    protected function casts(): array
    {
        return [
            'cover_source' => CoverSource::class,
            'year' => 'integer',
            'sort' => 'integer',
            'legacy_wp_id' => 'integer',
        ];
    }

    public static function referenceKind(): ReferenceKind
    {
        return ReferenceKind::Releases;
    }

    protected static function newFactory(): ReleaseFactory
    {
        return ReleaseFactory::new();
    }

    /**
     * @return BelongsTo<Media, $this>
     */
    public function coverMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'cover_media_id');
    }

    /**
     * @return BelongsTo<Media, $this>
     */
    public function trackMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'track_media_id');
    }

    /**
     * @return BelongsTo<RecordLabel, $this>
     */
    public function recordLabel(): BelongsTo
    {
        return $this->belongsTo(RecordLabel::class);
    }

    /**
     * @return BelongsTo<Genre, $this>
     */
    public function primaryGenre(): BelongsTo
    {
        return $this->belongsTo(Genre::class, 'primary_genre_id');
    }

    /**
     * @return BelongsToMany<Genre, $this>
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    /**
     * @return HasMany<ReleaseLink, $this>
     */
    public function links(): HasMany
    {
        return $this->hasMany(ReleaseLink::class)->orderBy('sort');
    }
}
