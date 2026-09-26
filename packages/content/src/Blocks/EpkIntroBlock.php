<?php

namespace Djfabrizia\Content\Blocks;

/**
 * EPK contact header.
 */
final class EpkIntroBlock extends Block
{
    public function rules(): array
    {
        return [
            'insta_stats_media_id' => self::ID,
            'insta_stats_alt' => self::LINE,
            'email_label' => self::LINE,
            'email_text' => self::LINE,
            'whatsapp_label' => self::LINE,
            'whatsapp_text' => self::LINE,
            'socials_label' => self::LINE,
            'socials_url' => self::URL,
            'website_label' => self::LINE,
        ];
    }

    public function defaults(): array
    {
        return ['insta_stats_media_id' => null, 'insta_stats_alt' => null, 'email_label' => null, 'email_text' => null, 'whatsapp_label' => null, 'whatsapp_text' => null, 'socials_label' => null, 'socials_url' => null, 'website_label' => null];
    }

    public function references(): array
    {
        return ['media' => ['insta_stats_media_id']];
    }
}
