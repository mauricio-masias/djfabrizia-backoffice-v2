<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Model;

/**
 * Editorial key/value settings, grouped (e.g. group "youtube", key "channel_id").
 * Environment-specific hosts never live here: they stay in .env/config.
 *
 * @property int $id
 * @property string $group
 * @property string $key
 * @property mixed $value
 */
class Setting extends Model
{
    use UsesContentConnection;

    protected $fillable = [
        'group',
        'key',
        'value',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'json',
        ];
    }

    public static function value(string $group, string $key, mixed $default = null): mixed
    {
        $setting = static::query()->where('group', $group)->where('key', $key)->first();

        return $setting === null ? $default : ($setting->value ?? $default);
    }

    public static function put(string $group, string $key, mixed $value): self
    {
        return static::query()->updateOrCreate(['group' => $group, 'key' => $key], ['value' => $value]);
    }
}
