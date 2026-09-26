<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Database\Factories\GenreFactory;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Shared music genre for mixes and releases. Genres with a null sort position
 * were created automatically from source tags and are still unreviewed.
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property list<string>|null $aliases
 * @property int|null $sort
 */
class Genre extends Model
{
    /** @use HasFactory<GenreFactory> */
    use HasFactory, UsesContentConnection;

    protected $fillable = [
        'name',
        'slug',
        'aliases',
        'sort',
    ];

    protected function casts(): array
    {
        return [
            'aliases' => 'array',
            'sort' => 'integer',
        ];
    }

    protected static function newFactory(): GenreFactory
    {
        return GenreFactory::new();
    }

    /**
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeUnreviewed(Builder $query): Builder
    {
        return $query->whereNull('sort');
    }

    /**
     * @return BelongsToMany<Mix, $this>
     */
    public function mixes(): BelongsToMany
    {
        return $this->belongsToMany(Mix::class);
    }

    /**
     * @return BelongsToMany<Release, $this>
     */
    public function releases(): BelongsToMany
    {
        return $this->belongsToMany(Release::class);
    }

    /**
     * Releases that use this genre as their primary style.
     *
     * @return HasMany<Release, $this>
     */
    public function primaryReleases(): HasMany
    {
        return $this->hasMany(Release::class, 'primary_genre_id');
    }
}
