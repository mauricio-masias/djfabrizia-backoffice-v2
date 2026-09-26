<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Database\Factories\MenuFactory;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $slug main, footer or mobile
 * @property string $name
 * @property int|null $legacy_wp_id WordPress nav_menu term_taxonomy_id
 */
class Menu extends Model
{
    /** @use HasFactory<MenuFactory> */
    use HasFactory, UsesContentConnection;

    protected $fillable = [
        'slug',
        'name',
        'legacy_wp_id',
    ];

    protected function casts(): array
    {
        return [
            'legacy_wp_id' => 'integer',
        ];
    }

    protected static function newFactory(): MenuFactory
    {
        return MenuFactory::new();
    }

    /**
     * Every item of the menu, flat, in display order.
     *
     * @return HasMany<MenuItem, $this>
     */
    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class)->orderBy('sort');
    }
}
