<?php

namespace Djfabrizia\Content\Enums;

use Djfabrizia\Content\Blocks\BlockType;
use Djfabrizia\Content\Concerns\HasLabel;

/**
 * Page templates. A template decides which blocks the page builder offers and
 * the skeleton a new page starts with. EPK variants are independent pages: the
 * EN and IT pages of one template share the allowed blocks, never the content.
 */
enum PageTemplate: string
{
    use HasLabel;

    case Home = 'home';
    case Bio = 'bio';
    case Social = 'social';
    case Videos = 'videos';
    case Linktree = 'linktree';
    case Legal = 'legal';
    case EpkDefault = 'epk_default';
    case EpkSpecial = 'epk_special';
    case EpkUnderground = 'epk_underground';

    public function isEpk(): bool
    {
        return in_array($this, [self::EpkDefault, self::EpkSpecial, self::EpkUnderground], true);
    }

    /**
     * The EPK variant name used in URLs (/epk/{locale}/{variant}), or null.
     */
    public function epkVariant(): ?string
    {
        return match ($this) {
            self::EpkDefault => 'default',
            self::EpkSpecial => 'special',
            self::EpkUnderground => 'underground',
            default => null,
        };
    }

    /**
     * @return list<BlockType>
     */
    public function allowedBlocks(): array
    {
        return match ($this) {
            self::Home => [
                BlockType::HeroRotator,
                BlockType::RichTwoColumn,
                BlockType::CollectionFeed,
                BlockType::Booking,
                BlockType::InstagramFeed,
                BlockType::ReleaseSpotlight,
                BlockType::CtaBanner,
            ],
            self::Bio => [
                BlockType::RichTwoColumn,
                BlockType::VenuesUk,
                BlockType::VenuesInternational,
                BlockType::CtaBanner,
            ],
            self::Social => [BlockType::SocialPanel],
            self::Videos => [BlockType::CollectionFeed],
            self::Linktree => [BlockType::Linktree],
            self::Legal => [BlockType::LegalContent],
            self::EpkDefault => [
                BlockType::EpkIntro,
                BlockType::EpkReel,
                BlockType::EpkIdealFor,
                BlockType::EpkTextSection,
                BlockType::EpkGallery,
                BlockType::EpkOffers,
                BlockType::EpkVideos,
                BlockType::EpkMixes,
            ],
            self::EpkSpecial => [
                BlockType::EpkIntro,
                BlockType::EpkReel,
                BlockType::EpkVideos,
                BlockType::EpkGallery,
                BlockType::EpkMixes,
                BlockType::EpkIdealFor,
                BlockType::EpkOffers,
                BlockType::EpkTextSection,
            ],
            self::EpkUnderground => [
                BlockType::EpkIntro,
                BlockType::EpkReel,
                BlockType::EpkMixes,
                BlockType::EpkVideos,
                BlockType::EpkIdealFor,
                BlockType::EpkGallery,
                BlockType::EpkLiveFormat,
                BlockType::EpkNotableVenues,
                BlockType::EpkProducer,
                BlockType::EpkBestSuited,
            ],
        };
    }

    public function allows(BlockType $type): bool
    {
        return in_array($type, $this->allowedBlocks(), true);
    }

    /**
     * Blocks a new page of this template starts with, in display order.
     *
     * @return list<array{type: string, data: array<string, mixed>}>
     */
    public function skeleton(): array
    {
        $blocks = match ($this) {
            self::Home => [
                [BlockType::HeroRotator, []],
                [BlockType::RichTwoColumn, []],
                [BlockType::CollectionFeed, ['collection' => 'mixes']],
                [BlockType::CollectionFeed, ['collection' => 'releases']],
                [BlockType::CollectionFeed, ['collection' => 'playlists']],
                [BlockType::Booking, []],
            ],
            self::Bio => [
                [BlockType::RichTwoColumn, []],
                [BlockType::VenuesUk, []],
                [BlockType::VenuesInternational, []],
            ],
            self::Social => [[BlockType::SocialPanel, []]],
            self::Videos => [[BlockType::CollectionFeed, ['collection' => 'videos', 'per_page' => 16]]],
            self::Linktree => [[BlockType::Linktree, []]],
            self::Legal => [[BlockType::LegalContent, []]],
            self::EpkDefault => [
                [BlockType::EpkIntro, []],
                [BlockType::EpkReel, []],
                [BlockType::EpkIdealFor, []],
                [BlockType::EpkTextSection, ['role' => 'tailored']],
                [BlockType::EpkTextSection, ['role' => 'renowned']],
                [BlockType::EpkTextSection, ['role' => 'worldwide']],
                [BlockType::EpkGallery, []],
                [BlockType::EpkOffers, []],
                [BlockType::EpkVideos, []],
                [BlockType::EpkMixes, []],
            ],
            self::EpkSpecial => [
                [BlockType::EpkIntro, []],
                [BlockType::EpkReel, []],
                [BlockType::EpkVideos, []],
                [BlockType::EpkGallery, []],
                [BlockType::EpkMixes, []],
                [BlockType::EpkIdealFor, []],
                [BlockType::EpkOffers, []],
                [BlockType::EpkTextSection, ['role' => 'tailored']],
                [BlockType::EpkTextSection, ['role' => 'renowned']],
                [BlockType::EpkTextSection, ['role' => 'worldwide']],
            ],
            self::EpkUnderground => [
                [BlockType::EpkIntro, []],
                [BlockType::EpkReel, []],
                [BlockType::EpkMixes, []],
                [BlockType::EpkVideos, []],
                [BlockType::EpkIdealFor, []],
                [BlockType::EpkGallery, []],
                [BlockType::EpkLiveFormat, []],
                [BlockType::EpkNotableVenues, []],
                [BlockType::EpkProducer, []],
                [BlockType::EpkBestSuited, []],
            ],
        };

        return array_values(array_map(
            static fn (array $block): array => [
                'type' => $block[0]->value,
                'data' => array_replace($block[0]->definition()->defaults(), $block[1]),
            ],
            $blocks,
        ));
    }
}
