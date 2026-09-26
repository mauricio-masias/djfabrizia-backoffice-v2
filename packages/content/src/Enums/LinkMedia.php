<?php

namespace Djfabrizia\Content\Enums;

use Djfabrizia\Content\Concerns\HasLabel;

/**
 * Linktree link kinds. The values match the WordPress `link_media` select:
 * a platform uses the matching social URL, "<platform>-custom" swaps the user
 * segment of that URL, and "custom" is a free URL.
 */
enum LinkMedia: string
{
    use HasLabel;

    case Instagram = 'instagram';
    case Facebook = 'facebook';
    case X = 'x';
    case Youtube = 'youtube';
    case Mixcloud = 'mixcloud';
    case Spotify = 'spotify';
    case InstagramCustom = 'instagram-custom';
    case FacebookCustom = 'facebook-custom';
    case XCustom = 'x-custom';
    case YoutubeCustom = 'youtube-custom';
    case MixcloudCustom = 'mixcloud-custom';
    case SpotifyCustom = 'spotify-custom';
    case Custom = 'custom';

    public function isCustomHandle(): bool
    {
        return str_ends_with($this->value, '-custom');
    }

    /**
     * The platform name without the "-custom" suffix, or null for a free URL.
     */
    public function platform(): ?string
    {
        if ($this === self::Custom) {
            return null;
        }

        return str_replace('-custom', '', $this->value);
    }
}
