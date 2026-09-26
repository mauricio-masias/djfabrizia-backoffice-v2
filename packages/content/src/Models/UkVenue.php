<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Database\Factories\UkVenueFactory;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $sort
 * @property string|null $legacy_key
 */
class UkVenue extends Model
{
    /** @use HasFactory<UkVenueFactory> */
    use HasFactory, UsesContentConnection;

    protected $fillable = [
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

    protected static function newFactory(): UkVenueFactory
    {
        return UkVenueFactory::new();
    }
}
