<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Database\Factories\ClubFactory;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $city_id
 * @property string $name
 * @property int $sort
 * @property string|null $legacy_key
 */
class Club extends Model
{
    /** @use HasFactory<ClubFactory> */
    use HasFactory, UsesContentConnection;

    protected $fillable = [
        'city_id',
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

    protected static function newFactory(): ClubFactory
    {
        return ClubFactory::new();
    }

    /**
     * @return BelongsTo<City, $this>
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
