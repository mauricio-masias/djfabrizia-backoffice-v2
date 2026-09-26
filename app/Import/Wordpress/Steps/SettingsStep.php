<?php

namespace App\Import\Wordpress\Steps;

use App\Import\Wordpress\ImportContext;
use App\Settings\SiteSettings;
use Djfabrizia\Content\Models\Setting;

/**
 * Fills the sync account settings from the WordPress data, without
 * overwriting values an editor has already set.
 */
class SettingsStep implements ImportStep
{
    private const VIDEOS_PAGE_ID = 39;

    public function name(): string
    {
        return 'settings';
    }

    public function run(ImportContext $context): void
    {
        $firstMixUrl = $context->source->meta((int) ($context->source->posts('mixes')->first()->ID ?? 0))->get('mix_url');
        $ownerIds = $context->source->posts('playlists')
            ->map(fn (object $post): ?string => $context->source->meta($post->ID)->get('owner_id'))
            ->filter()
            ->countBy();

        $defaults = [
            'mixcloud_user' => $firstMixUrl ? explode('/', trim($firstMixUrl, '/'))[0] : null,
            'spotify_user_id' => $ownerIds->sortDesc()->keys()->first(),
            'youtube_channel_id' => $context->source->meta(self::VIDEOS_PAGE_ID)->get('video_channel_id'),
        ];

        foreach ($defaults as $key => $value) {
            if ($value === null || $value === '' || filled(SiteSettings::get('sync', $key))) {
                continue;
            }

            $context->saved($this->name(), Setting::put('sync', $key, $value));
        }
    }
}
