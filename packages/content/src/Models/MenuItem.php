<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Database\Factories\MenuItemFactory;
use Djfabrizia\Content\Enums\MenuTarget;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $menu_id
 * @property int|null $parent_id
 * @property string $title
 * @property string $url
 * @property MenuTarget $target
 * @property string|null $icon icon name; v1 renders it as an "icon-<name>" title
 * @property int $sort
 * @property int|null $legacy_wp_id
 */
class MenuItem extends Model
{
    /** @use HasFactory<MenuItemFactory> */
    use HasFactory, UsesContentConnection;

    protected $fillable = [
        'menu_id',
        'parent_id',
        'title',
        'url',
        'target',
        'icon',
        'sort',
        'legacy_wp_id',
    ];

    protected $attributes = [
        'target' => '_self',
        'sort' => 0,
    ];

    protected function casts(): array
    {
        return [
            'target' => MenuTarget::class,
            'sort' => 'integer',
            'legacy_wp_id' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        // An item can never be its own parent.
        static::saving(function (self $item): void {
            if ($item->exists && $item->parent_id === $item->getKey()) {
                $item->parent_id = null;
            }
        });
    }

    protected static function newFactory(): MenuItemFactory
    {
        return MenuItemFactory::new();
    }

    /**
     * @return BelongsTo<Menu, $this>
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * @return BelongsTo<MenuItem, $this>
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * @return HasMany<MenuItem, $this>
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('sort');
    }
}
