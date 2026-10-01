<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Blocks\BlockType;
use Djfabrizia\Content\Database\Factories\PageFactory;
use Djfabrizia\Content\Enums\PageLocale;
use Djfabrizia\Content\Enums\PageTemplate;
use Djfabrizia\Content\Models\Concerns\Publishable;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * A page built from ordered blocks (Filament Builder shape).
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property PageTemplate $template
 * @property PageLocale $locale
 * @property list<array<string, mixed>> $blocks stored Builder items: ['type' => string, 'data' => array]
 * @property array<string, mixed>|null $seo
 * @property int|null $legacy_wp_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Page extends Model
{
    /** @use HasFactory<PageFactory> */
    use HasFactory, Publishable, UsesContentConnection;

    protected $fillable = [
        'slug',
        'title',
        'template',
        'locale',
        'status',
        'blocks',
        'seo',
        'published_at',
        'legacy_wp_id',
    ];

    protected $attributes = [
        'locale' => 'en',
        'status' => 'draft',
        'blocks' => '[]',
    ];

    protected function casts(): array
    {
        return [
            'template' => PageTemplate::class,
            'locale' => PageLocale::class,
            'blocks' => 'array',
            'seo' => 'array',
            'legacy_wp_id' => 'integer',
        ];
    }

    protected static function newFactory(): PageFactory
    {
        return PageFactory::new();
    }

    /**
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeEpk(Builder $query, PageLocale $locale, PageTemplate $template): Builder
    {
        return $query->where('template', $template->value)->where('locale', $locale->value);
    }

    /**
     * Data of every block of the given type, in page order.
     *
     * @return list<array<string, mixed>>
     */
    public function blocksOfType(BlockType $type): array
    {
        $found = [];

        foreach ($this->blocks as $block) {
            if (($block['type'] ?? null) === $type->value && is_array($block['data'] ?? null)) {
                $found[] = $block['data'];
            }
        }

        return $found;
    }

    /**
     * Data of the first block of the given type (optionally matching a field),
     * or null when the page has none.
     *
     * @return array<string, mixed>|null
     */
    public function firstBlock(BlockType $type, ?string $field = null, mixed $value = null): ?array
    {
        foreach ($this->blocksOfType($type) as $data) {
            if ($field === null || ($data[$field] ?? null) === $value) {
                return $data;
            }
        }

        return null;
    }
}
