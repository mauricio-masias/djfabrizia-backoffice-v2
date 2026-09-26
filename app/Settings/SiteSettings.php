<?php

namespace App\Settings;

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
        ],
        'bookings' => [
            'notify_email' => 'Send new booking requests to',
        ],
    ];

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
                $values[$group][$key] = self::get($group, $key);
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
