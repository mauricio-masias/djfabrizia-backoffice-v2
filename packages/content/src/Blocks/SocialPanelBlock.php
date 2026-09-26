<?php

namespace Djfabrizia\Content\Blocks;

/**
 * Social page copy (icons come from social_links).
 */
final class SocialPanelBlock extends Block
{
    public function rules(): array
    {
        return [
            'title' => self::LINE,
            'above_icons' => self::TEXT,
            'below_icons' => self::TEXT,
            'subscribe' => self::TEXT,
            'follow' => self::TEXT,
            'ad_link' => self::URL,
            'ad_image' => self::URL,
            'ad_alt' => self::LINE,
            'yt_channel' => self::LINE,
            'facebook_id' => self::LINE,
        ];
    }

    public function defaults(): array
    {
        return ['title' => null, 'above_icons' => null, 'below_icons' => null, 'subscribe' => null, 'follow' => null, 'ad_link' => null, 'ad_image' => null, 'ad_alt' => null, 'yt_channel' => null, 'facebook_id' => null];
    }
}
