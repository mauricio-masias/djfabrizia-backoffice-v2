<?php

namespace Djfabrizia\Content\Blocks;

use Djfabrizia\Content\Concerns\HasLabel;

enum BlockType: string
{
    use HasLabel;

    case HeroRotator = 'hero_rotator';
    case RichTwoColumn = 'rich_two_column';
    case Booking = 'booking';
    case CollectionFeed = 'collection_feed';
    case VenuesUk = 'venues_uk';
    case VenuesInternational = 'venues_international';
    case SocialPanel = 'social_panel';
    case Linktree = 'linktree';
    case LegalContent = 'legal_content';
    case InstagramFeed = 'instagram_feed';
    case ReleaseSpotlight = 'release_spotlight';
    case CtaBanner = 'cta_banner';
    case EpkIntro = 'epk_intro';
    case EpkReel = 'epk_reel';
    case EpkGallery = 'epk_gallery';
    case EpkIdealFor = 'epk_ideal_for';
    case EpkTextSection = 'epk_text_section';
    case EpkOffers = 'epk_offers';
    case EpkVideos = 'epk_videos';
    case EpkMixes = 'epk_mixes';
    case EpkLiveFormat = 'epk_live_format';
    case EpkNotableVenues = 'epk_notable_venues';
    case EpkProducer = 'epk_producer';
    case EpkBestSuited = 'epk_best_suited';

    public function definition(): Block
    {
        return match ($this) {
            self::HeroRotator => new HeroRotatorBlock,
            self::RichTwoColumn => new RichTwoColumnBlock,
            self::Booking => new BookingBlock,
            self::CollectionFeed => new CollectionFeedBlock,
            self::VenuesUk => new VenuesUkBlock,
            self::VenuesInternational => new VenuesInternationalBlock,
            self::SocialPanel => new SocialPanelBlock,
            self::Linktree => new LinktreeBlock,
            self::LegalContent => new LegalContentBlock,
            self::InstagramFeed => new InstagramFeedBlock,
            self::ReleaseSpotlight => new ReleaseSpotlightBlock,
            self::CtaBanner => new CtaBannerBlock,
            self::EpkIntro => new EpkIntroBlock,
            self::EpkReel => new EpkReelBlock,
            self::EpkGallery => new EpkGalleryBlock,
            self::EpkIdealFor => new EpkIdealForBlock,
            self::EpkTextSection => new EpkTextSectionBlock,
            self::EpkOffers => new EpkOffersBlock,
            self::EpkVideos => new EpkVideosBlock,
            self::EpkMixes => new EpkMixesBlock,
            self::EpkLiveFormat => new EpkLiveFormatBlock,
            self::EpkNotableVenues => new EpkNotableVenuesBlock,
            self::EpkProducer => new EpkProducerBlock,
            self::EpkBestSuited => new EpkBestSuitedBlock,
        };
    }
}
