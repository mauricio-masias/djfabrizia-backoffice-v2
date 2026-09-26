<?php

namespace App\Import\Wordpress\Pages;

use App\Import\Wordpress\ImportContext;
use App\Import\Wordpress\Meta;
use Djfabrizia\Content\Blocks\BlockType;
use Djfabrizia\Content\Enums\PageTemplate;
use Djfabrizia\Content\Legacy\EpkLegacyMap;
use Djfabrizia\Content\Legacy\ProducerListFormat;
use Illuminate\Support\Arr;

/**
 * Builds a page's blocks from its WordPress meta, one mapping per template.
 */
final class PageBlocksBuilder
{
    /** Videos per page in v1 (VideoService::LIMIT). */
    private const VIDEOS_PER_PAGE = 16;

    public function __construct(private readonly EpkMetaReader $epkReader) {}

    /**
     * @param  object{post_content: string}  $post
     * @return list<array{type: string, data: array<string, mixed>}>
     */
    public function build(PageTemplate $template, Meta $meta, object $post, ImportContext $context): array
    {
        return match ($template) {
            PageTemplate::Home => [
                self::block(BlockType::HeroRotator, ['styles' => $meta->matching('/^hero_rotator_\d+_item$/')]),
                self::block(BlockType::RichTwoColumn, [
                    'title' => $meta->get('about_me_title'),
                    'left' => $meta->get('about_me_left'),
                    'right' => $meta->get('about_me_right'),
                    'left_link' => $meta->get('about_me_left_link'),
                    'right_link' => $meta->get('about_me_right_link'),
                ]),
                $this->feed($meta, 'mixes'),
                $this->feed($meta, 'releases'),
                $this->feed($meta, 'playlists'),
                self::block(BlockType::Booking, [
                    'title' => $meta->get('book_me_title'),
                    'left' => $meta->get('book_me_left'),
                    'right' => $meta->get('book_me_right'),
                    'success' => $meta->get('book_me_success'),
                    'modal' => [
                        'pa' => $meta->get('book_me_pa'),
                        'lights' => $meta->get('book_me_lights'),
                        'booth' => $meta->get('book_me_booth'),
                        'controller' => $meta->get('book_me_controller'),
                    ],
                ]),
            ],
            PageTemplate::Bio => [
                self::block(BlockType::RichTwoColumn, [
                    'title' => $meta->get('bio_title'),
                    'left' => $meta->get('bio_left'),
                    'right' => $meta->get('bio_right'),
                ]),
                self::block(BlockType::VenuesUk, ['title' => $meta->get('uk_gigs_title')]),
                self::block(BlockType::VenuesInternational, ['title' => $meta->get('international_title')]),
            ],
            PageTemplate::Social => [
                self::block(BlockType::SocialPanel, [
                    'title' => $meta->get('social_title'),
                    'above_icons' => $meta->get('social_aboveicons'),
                    'below_icons' => $meta->get('social_belowicons'),
                    'subscribe' => $meta->get('social_subscribe'),
                    'follow' => $meta->get('social_follow'),
                    'ad_link' => $meta->get('social_ad_link'),
                    'ad_image' => $meta->get('social_ad_img'),
                    'ad_alt' => $meta->get('social_ad_alt'),
                    'yt_channel' => $meta->get('social_yt_channel'),
                    'facebook_id' => $meta->get('social_facebook_id'),
                ]),
            ],
            PageTemplate::Videos => [
                self::block(BlockType::CollectionFeed, [
                    'collection' => 'videos',
                    'title' => $meta->get('video_title'),
                    'per_page' => self::VIDEOS_PER_PAGE,
                    'channel_id' => $meta->get('video_channel_id'),
                ]),
            ],
            PageTemplate::Linktree => [
                self::block(BlockType::Linktree, [
                    'hero_media_id' => $context->idFor('media', $meta->get('linkt_top_image')),
                    'title' => $meta->get('linkt_top_title'),
                    'teaser' => $meta->get('linkt_top_teaser'),
                    'page_bg' => $meta->get('linkt_page_background') ?: null,
                    'font_color' => $meta->get('linkt_font_color') ?: null,
                    'font_position' => $meta->serializedList('linkt_font_position')[0] ?? null,
                ]),
            ],
            PageTemplate::Legal => [
                self::block(BlockType::LegalContent, ['html' => $post->post_content]),
            ],
            PageTemplate::EpkDefault, PageTemplate::EpkSpecial, PageTemplate::EpkUnderground => $this->epk($template, $meta, $context),
        };
    }

    /**
     * @return array{type: string, data: array<string, mixed>}
     */
    private function feed(Meta $meta, string $collection): array
    {
        return self::block(BlockType::CollectionFeed, [
            'collection' => $collection,
            'title' => $meta->get("{$collection}_title"),
            'per_page' => $meta->int("{$collection}_paginate") ?? 6,
            'more_label' => $meta->get("{$collection}_more_button"),
        ]);
    }

    /**
     * Starts from the template skeleton (block order and text-section roles)
     * and fills each mapped field from the legacy payload.
     *
     * @return list<array{type: string, data: array<string, mixed>}>
     */
    private function epk(PageTemplate $template, Meta $meta, ImportContext $context): array
    {
        $legacy = $this->epkReader->read($meta);
        $blocks = $template->skeleton();

        foreach (EpkLegacyMap::for($template) as $entry) {
            $value = $this->convert($entry['kind'], Arr::get($legacy, $entry['legacy']), $context);

            if ($value === null) {
                continue;
            }

            foreach ($blocks as $index => $block) {
                if ($block['type'] === $entry['block']->value && ($entry['role'] === null || ($block['data']['role'] ?? null) === $entry['role'])) {
                    data_set($blocks[$index]['data'], $entry['field'], $value);

                    break;
                }
            }
        }

        // Offer items are positional (offerN is items[N-1]): fill gaps with empty
        // items instead of re-indexing, so an empty offer1 never shifts offer4.
        foreach ($blocks as $index => $block) {
            $items = $block['data']['items'] ?? null;

            if (is_array($items) && $items !== [] && ! array_is_list($items)) {
                $filled = [];

                for ($position = 0; $position <= max(array_keys($items)); $position++) {
                    $filled[] = $items[$position] ?? [];
                }

                $blocks[$index]['data']['items'] = $filled;
            }
        }

        return $blocks;
    }

    private function convert(string $kind, mixed $value, ImportContext $context): mixed
    {
        return match ($kind) {
            'media' => $context->idFor('media', $value),
            'media_list' => array_values(array_filter(array_map(fn (mixed $id): ?int => $context->idFor('media', $id), (array) $value))),
            'list' => array_values(array_filter((array) $value, fn (mixed $item): bool => is_string($item) && $item !== '')),
            'producer_groups' => ProducerListFormat::parse(is_string($value) ? $value : null),
            'videos' => array_map(fn (array $video): array => [
                'label' => $video['label'],
                'alt' => $video['alt'],
                'url' => $video['url'],
                'image_media_id' => $context->idFor('media', $video['img']),
            ], (array) $value),
            'mixes' => array_values(array_filter(array_map(function (array $row) use ($context): ?array {
                $mixId = $context->idFor('mixes', $row['mix']);

                if ($mixId === null) {
                    $context->warn("[pages] EPK mix {$row['mix']} was not imported; dropped from the page");

                    return null;
                }

                return ['label' => $row['label'], 'mix_id' => $mixId];
            }, (array) $value))),
            default => $value,
        };
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array{type: string, data: array<string, mixed>}
     */
    private static function block(BlockType $type, array $data): array
    {
        return ['type' => $type->value, 'data' => array_replace($type->definition()->defaults(), $data)];
    }
}
