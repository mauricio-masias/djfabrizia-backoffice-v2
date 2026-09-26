<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Database\Factories\CountryFactory;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property bool $is_default open by default in the international list
 * @property int $sort
 * @property int|null $legacy_wp_id
 */
class Country extends Model
{
    /** @use HasFactory<CountryFactory> */
    use HasFactory, UsesContentConnection;

    protected $fillable = [
        'name',
        'is_default',
        'sort',
        'legacy_wp_id',
    ];

    protected $attributes = [
        'is_default' => false,
        'sort' => 0,
    ];

    protected function casts(): array
    {
        return [
            'is_default' => 'boolean',
            'sort' => 'integer',
            'legacy_wp_id' => 'integer',
        ];
    }

    protected static function newFactory(): CountryFactory
    {
        return CountryFactory::new();
    }

    /**
     * @return HasMany<City, $this>
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class)->orderBy('sort');
    }
}
