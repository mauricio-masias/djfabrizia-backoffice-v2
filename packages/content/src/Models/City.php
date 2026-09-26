<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Database\Factories\CityFactory;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $country_id
 * @property string $name
 * @property int $sort
 * @property string|null $legacy_key
 */
class City extends Model
{
    /** @use HasFactory<CityFactory> */
    use HasFactory, UsesContentConnection;

    protected $fillable = [
        'country_id',
        'name',
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

    protected static function newFactory(): CityFactory
    {
        return CityFactory::new();
    }

    /**
     * @return BelongsTo<Country, $this>
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return HasMany<Club, $this>
     */
    public function clubs(): HasMany
    {
        return $this->hasMany(Club::class)->orderBy('sort');
    }
}
