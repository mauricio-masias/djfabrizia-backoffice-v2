<?php

namespace Djfabrizia\Content\Legacy;

use Djfabrizia\Content\Blocks\BlockType;
use Djfabrizia\Content\Enums\PageTemplate;

/**
 * Where each field of the legacy v1 EPK payload lives in the page blocks.
 *
 * The WordPress EPK pages all shared one generic ACF schema; the special and
 * underground frontends reuse some generic fields for other sections (see
 * CMS_PLAN.md Appendix B). This map is used in both directions: the importer
 * turns WordPress meta into blocks, and the endpoint's v1 rebuilds the legacy
 * payload from blocks, so the two can never drift apart.
 *
 * Kinds:
 *  - text:       plain value
 *  - media:      one media ID (legacy payload: the file path)
 *  - media_list: list of media IDs (legacy payload: list of paths)
 *  - list:       list of strings
 *  - videos:     list of {label, alt, url, image_media_id} (legacy: {label, alt, url, img})
 *  - mixes:      list of {label, mix_id} (legacy: {label, url, img})
 *  - producer_groups: list of {title, items} (legacy: ProducerListFormat text)
 *
 * A legacy field with no entry for a template is not imported for that
 * template (its frontend never reads it); v1 returns null for it.
 */
final class EpkLegacyMap
{
    /**
     * @return list<array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}>
     */
    public static function for(PageTemplate $template): array
    {
        return match ($template) {
            PageTemplate::EpkDefault, PageTemplate::EpkSpecial => [
                ...self::intro(),
                ...self::reel(),
                ...self::gallery(),
                ...self::idealFor(),
                ...self::textSections(),
                ...self::offers(range(1, 6)),
                ...self::videos(),
                ...self::mixes(),
            ],
            PageTemplate::EpkUnderground => [
                ...self::intro(),
                ...self::reel(),
                ...self::gallery(),
                ...self::idealFor(),
                ...self::videos(),
                ...self::mixes(),
                self::entry('about.tailored_title', BlockType::EpkLiveFormat, 'title'),
                self::entry('about.tailored_text', BlockType::EpkLiveFormat, 'text'),
                self::entry('about.renowed_text', BlockType::EpkLiveFormat, 'text_b'),
                self::entry('about.worldwide_title', BlockType::EpkNotableVenues, 'title'),
                self::entry('about.worldwide_text', BlockType::EpkNotableVenues, 'text'),
                self::entry('about.worldwide_link_label', BlockType::EpkNotableVenues, 'link_label'),
                self::entry('about.worldwide_link_url', BlockType::EpkNotableVenues, 'link_url'),
                self::entry('whatOffers.offer4', BlockType::EpkProducer, 'title'),
                self::entry('whatOffers.offer4_text', BlockType::EpkProducer, 'groups', kind: 'producer_groups'),
                self::entry('whatOffers.offer5', BlockType::EpkBestSuited, 'title'),
                self::entry('whatOffers.offer5_text', BlockType::EpkBestSuited, 'text'),
                self::entry('whatOffers.offer5_text_b', BlockType::EpkBestSuited, 'text_b'),
                self::entry('whatOffers.offer6_text', BlockType::EpkBestSuited, 'text_c'),
            ],
            default => [],
        };
    }

    /**
     * @return list<array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}>
     */
    private static function intro(): array
    {
        return [
            self::entry('intro.insta_stats_img', BlockType::EpkIntro, 'insta_stats_media_id', kind: 'media'),
            self::entry('intro.insta_stats_alt', BlockType::EpkIntro, 'insta_stats_alt'),
            self::entry('intro.email_label', BlockType::EpkIntro, 'email_label'),
            self::entry('intro.email_text', BlockType::EpkIntro, 'email_text'),
            self::entry('intro.whatsapp_label', BlockType::EpkIntro, 'whatsapp_label'),
            self::entry('intro.whatsapp_text', BlockType::EpkIntro, 'whatsapp_text'),
            self::entry('intro.socials_label', BlockType::EpkIntro, 'socials_label'),
            self::entry('intro.socials_url', BlockType::EpkIntro, 'socials_url'),
            self::entry('intro.website_label', BlockType::EpkIntro, 'website_label'),
        ];
    }

    /**
     * @return list<array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}>
     */
    private static function reel(): array
    {
        return [
            self::entry('about.reel_title', BlockType::EpkReel, 'title'),
            self::entry('about.reel_cta', BlockType::EpkReel, 'cta'),
            self::entry('about.reel_url', BlockType::EpkReel, 'url'),
            self::entry('about.reel_image', BlockType::EpkReel, 'image_media_id', kind: 'media'),
            self::entry('about.intro_a', BlockType::EpkReel, 'intro_a'),
            self::entry('about.intro_b', BlockType::EpkReel, 'intro_b'),
        ];
    }

    /**
     * @return list<array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}>
     */
    private static function gallery(): array
    {
        return [
            self::entry('about.collaboration_title', BlockType::EpkGallery, 'title'),
            self::entry('about.collaboration_text', BlockType::EpkGallery, 'text'),
            self::entry('about.collaboration_text_b', BlockType::EpkGallery, 'text_b'),
            self::entry('about.carousel', BlockType::EpkGallery, 'image_media_ids', kind: 'media_list'),
        ];
    }

    /**
     * @return list<array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}>
     */
    private static function idealFor(): array
    {
        return [
            self::entry('about.ideal_title', BlockType::EpkIdealFor, 'title'),
            self::entry('about.ideal_reasons', BlockType::EpkIdealFor, 'reasons', kind: 'list'),
        ];
    }

    /**
     * @return list<array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}>
     */
    private static function textSections(): array
    {
        return [
            self::entry('about.tailored_title', BlockType::EpkTextSection, 'title', role: 'tailored'),
            self::entry('about.tailored_text', BlockType::EpkTextSection, 'text', role: 'tailored'),
            self::entry('about.renowed_title', BlockType::EpkTextSection, 'title', role: 'renowned'),
            self::entry('about.renowed_text', BlockType::EpkTextSection, 'text', role: 'renowned'),
            self::entry('about.renowed_text_b', BlockType::EpkTextSection, 'text_b', role: 'renowned'),
            self::entry('about.worldwide_title', BlockType::EpkTextSection, 'title', role: 'worldwide'),
            self::entry('about.worldwide_text', BlockType::EpkTextSection, 'text', role: 'worldwide'),
            self::entry('about.worldwide_link_label', BlockType::EpkTextSection, 'link_label', role: 'worldwide'),
            self::entry('about.worldwide_link_url', BlockType::EpkTextSection, 'link_url', role: 'worldwide'),
        ];
    }

    /**
     * @param  list<int>  $offers
     * @return list<array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}>
     */
    private static function offers(array $offers): array
    {
        $entries = [self::entry('whatOffers.title', BlockType::EpkOffers, 'title')];

        foreach ($offers as $number) {
            $index = $number - 1;
            $entries[] = self::entry("whatOffers.offer{$number}", BlockType::EpkOffers, "items.{$index}.title");
            $entries[] = self::entry("whatOffers.offer{$number}_text", BlockType::EpkOffers, "items.{$index}.text");
        }

        return [
            ...$entries,
            self::entry('whatOffers.offer5_text_b', BlockType::EpkOffers, 'items.4.text_b'),
            self::entry('whatOffers.setup_img', BlockType::EpkOffers, 'setup.image_media_id', kind: 'media'),
            self::entry('whatOffers.setup_alt', BlockType::EpkOffers, 'setup.alt'),
            self::entry('whatOffers.setup_url', BlockType::EpkOffers, 'setup.url'),
            self::entry('whatOffers.setup_cta', BlockType::EpkOffers, 'setup.cta'),
            self::entry('whatOffers.listen_here_1', BlockType::EpkOffers, 'listen_here_1'),
            self::entry('whatOffers.listen_here_2', BlockType::EpkOffers, 'listen_here_2'),
            self::entry('whatOffers.songs_by', BlockType::EpkOffers, 'songs_by'),
        ];
    }

    /**
     * @return list<array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}>
     */
    private static function videos(): array
    {
        return [
            self::entry('videos.corporate_title', BlockType::EpkVideos, 'corporate.title'),
            self::entry('videos.videos_corporate', BlockType::EpkVideos, 'corporate.items', kind: 'videos'),
            self::entry('videos.underground_title', BlockType::EpkVideos, 'underground.title'),
            self::entry('videos.videos_underground', BlockType::EpkVideos, 'underground.items', kind: 'videos'),
        ];
    }

    /**
     * @return list<array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}>
     */
    private static function mixes(): array
    {
        return [
            self::entry('mixes.title', BlockType::EpkMixes, 'title'),
            self::entry('mixes.mixes', BlockType::EpkMixes, 'items', kind: 'mixes'),
        ];
    }

    /**
     * @return array{legacy: string, block: BlockType, role: string|null, field: string, kind: string}
     */
    private static function entry(string $legacy, BlockType $block, string $field, ?string $role = null, string $kind = 'text'): array
    {
        return ['legacy' => $legacy, 'block' => $block, 'role' => $role, 'field' => $field, 'kind' => $kind];
    }
}
