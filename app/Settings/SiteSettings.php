<?php

namespace App\Settings;

use Djfabrizia\Content\Enums\SyncProvider;
use Djfabrizia\Content\Models\Setting;

/**
 * Editorial settings edited on the Settings page, stored in the `settings`
 * table. Environment-specific values (hosts, tokens, API keys) stay in .env.
 */
final class SiteSettings
{
    /**
     * group => key => label, in form order.
     *
     * @var array<string, array<string, string>>
     */
    public const FIELDS = [
        'sync' => [
            'mixcloud_user' => 'Mixcloud username',
            'spotify_user_id' => 'Spotify user ID',
            'youtube_channel_id' => 'YouTube channel ID',
            'mixcloud_enabled' => 'Mixcloud daily sync',
            'spotify_enabled' => 'Spotify daily sync',
            'youtube_enabled' => 'YouTube daily sync',
        ],
        'bookings' => [
            'notify_email' => 'Send new booking requests to',
        ],
    ];

    /**
     * Whether the scheduled daily sync runs for a provider. A missing value
     * means enabled; the manual "Sync now" action ignores this.
     */
    public static function syncEnabled(SyncProvider $provider): bool
    {
        return (bool) self::get('sync', $provider->value.'_enabled', true);
    }

    public static function get(string $group, string $key, mixed $default = null): mixed
    {
        return Setting::value($group, $key, $default);
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        $values = [];

        foreach (self::FIELDS as $group => $fields) {
            foreach (array_keys($fields) as $key) {
                $values[$group][$key] = str_ends_with($key, '_enabled')
                    ? (bool) self::get($group, $key, true)
                    : self::get($group, $key);
            }
        }

        return $values;
    }

    /**
     * @param  array<string, array<string, mixed>>  $values
     */
    public static function save(array $values): void
    {
        foreach (self::FIELDS as $group => $fields) {
            foreach (array_keys($fields) as $key) {
                Setting::put($group, $key, $values[$group][$key] ?? null);
            }
        }
    }
}
