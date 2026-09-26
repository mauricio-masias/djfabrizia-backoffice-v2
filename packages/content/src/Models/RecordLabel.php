<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Database\Factories\RecordLabelFactory;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $url
 */
class RecordLabel extends Model
{
    /** @use HasFactory<RecordLabelFactory> */
    use HasFactory, UsesContentConnection;

    protected $fillable = [
        'name',
        'slug',
        'url',
    ];

    protected static function newFactory(): RecordLabelFactory
    {
        return RecordLabelFactory::new();
    }

    /**
     * @return HasMany<Release, $this>
     */
    public function releases(): HasMany
    {
        return $this->hasMany(Release::class);
    }
}
