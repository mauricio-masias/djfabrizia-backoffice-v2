<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Database\Factories\SocialLinkFactory;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $network e.g. Instagram
 * @property string|null $icon_class e.g. fa-instagram
 * @property string|null $type
 * @property string $url
 * @property string|null $app_url deep link used on mobile
 * @property int $sort
 * @property string|null $legacy_key
 */
class SocialLink extends Model
{
    /** @use HasFactory<SocialLinkFactory> */
    use HasFactory, UsesContentConnection;

    protected $fillable = [
        'network',
        'icon_class',
        'type',
        'url',
        'app_url',
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

    protected static function newFactory(): SocialLinkFactory
    {
        return SocialLinkFactory::new();
    }
}
