<?php

namespace App\Import\Wordpress\Pages;

use App\Import\Wordpress\Meta;

/**
 * Reads an EPK page's generic ACF fields into the legacy v1 payload shape
 * (intro/about/whatOffers/videos/mixes), keeping raw WordPress IDs for images
 * and mixes. EpkLegacyMap then places each field in a block.
 */
final class EpkMetaReader
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public function read(Meta $meta): array
    {
        return [
            'intro' => [
                'insta_stats_img' => $meta->get('intro_insta_stats'),
                'insta_stats_alt' => $meta->get('intro_insta_stats_alt'),
                'email_label' => $meta->get('intro_email_label'),
                'email_text' => $meta->get('intro_email_text'),
                'whatsapp_label' => $meta->get('intro_whatsapp_label'),
                'whatsapp_text' => $meta->get('intro_whatsapp_text'),
                'socials_label' => $meta->get('intro_socials_label'),
                'socials_url' => $meta->get('intro_socials_text'),
                'website_label' => $meta->get('intro_website_label'),
            ],
            'about' => [
                ...$this->prefixed($meta, 'about_', [
                    'reel_url', 'reel_cta', 'reel_title', 'intro_a', 'intro_b', 'ideal_title',
                    'tailored_title', 'tailored_text', 'renowed_title', 'renowed_text', 'renowed_text_b',
                    'worldwide_title', 'worldwide_text', 'worldwide_link_label', 'worldwide_link_url',
                    'collaboration_title', 'collaboration_text', 'collaboration_text_b',
                ]),
                'reel_image' => $meta->get('about_reel_image'),
                'carousel' => $meta->serializedList('about_carousel'),
                'ideal_reasons' => array_column($meta->repeater('about_ideal_reasons', ['reason']), 'reason'),
            ],
            'whatOffers' => [
                ...$this->prefixed($meta, 'whatOffers_', [
                    'title', 'offer1', 'offer1_text', 'offer2', 'offer2_text', 'offer3', 'offer3_text',
                    'offer4', 'offer4_text', 'offer5', 'offer5_text', 'offer5_text_b', 'offer6', 'offer6_text',
                    'setup_cta', 'setup_url', 'setup_alt', 'listen_here_1', 'listen_here_2', 'songs_by',
                ]),
                'setup_img' => $meta->get('whatOffers_setup_image'),
            ],
            'videos' => [
                'corporate_title' => $meta->get('videos_corporate_title'),
                'underground_title' => $meta->get('videos_underground_title'),
                'videos_corporate' => $this->videos($meta, 'videos_corporate'),
                // The WordPress field name has always been misspelled.
                'videos_underground' => $this->videos($meta, 'videos_undergound'),
            ],
            'mixes' => [
                'title' => $meta->get('mixes_title'),
                'mixes' => $meta->repeater('mixes', ['label', 'mix']),
            ],
        ];
    }

    /**
     * @param  list<string>  $fields
     * @return array<string, string|null>
     */
    private function prefixed(Meta $meta, string $prefix, array $fields): array
    {
        $values = [];

        foreach ($fields as $field) {
            $values[$field] = $meta->get($prefix.$field);
        }

        return $values;
    }

    /**
     * @return list<array{label: string|null, alt: string|null, url: string|null, img: string|null}>
     */
    private function videos(Meta $meta, string $name): array
    {
        return array_map(
            static fn (array $row): array => ['label' => $row['label'], 'alt' => $row['alt_text'], 'url' => $row['url'], 'img' => $row['image']],
            $meta->repeater($name, ['label', 'alt_text', 'url', 'image']),
        );
    }
}
