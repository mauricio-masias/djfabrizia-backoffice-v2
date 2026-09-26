<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Database\Factories\LinkSectionFactory;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * A linktree section heading (e.g. "RECENT GIGS").
 *
 * @property int $id
 * @property string $label
 * @property int $sort
 * @property string|null $legacy_key
 */
class LinkSection extends Model
{
    /** @use HasFactory<LinkSectionFactory> */
    use HasFactory, UsesContentConnection;

    protected $fillable = [
        'label',
        'sort',
        'legacy_key',
    ];

    protected $attributes = [
        'sort' => 0,
    ];

    protected function casts(): array
    {
        return [
            'sort' => 'integer',
        ];
    }

    protected static function newFactory(): LinkSectionFactory
    {
        return LinkSectionFactory::new();
    }

    /**
     * @return BelongsToMany<Link, $this>
     */
    public function links(): BelongsToMany
    {
        return $this->belongsToMany(Link::class)->orderBy('links.sort');
    }
}
