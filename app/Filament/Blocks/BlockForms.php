<?php

namespace App\Filament\Blocks;

use App\Filament\Forms\MediaUpload;
use Djfabrizia\Content\Blocks\BlockType;
use Djfabrizia\Content\Enums\PageTemplate;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Release;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Support\Icons\Heroicon;

/**
 * Filament Builder blocks for the page block types. Field names and rules
 * mirror the block definitions in the content package; BlockValidator checks
 * the whole list again on save.
 *
 * Long texts are plain textareas on purpose: the stored text keeps the
 * WordPress line-break conventions v1 converts to HTML, and inline HTML
 * links written by editors are kept as they are.
 */
final class BlockForms
{
    /**
     * @return list<Block>
     */
    public static function forTemplate(?PageTemplate $template): array
    {
        return array_map(self::block(...), $template?->allowedBlocks() ?? []);
    }

    public static function block(BlockType $type): Block
    {
        return Block::make($type->value)
            ->label(fn (?array $state): string => self::itemLabel($type, $state))
            ->icon(self::icon($type))
            ->columns(2)
            ->schema(self::schema($type));
    }

    /**
     * @param  array<string, mixed>|null  $state
     */
    private static function itemLabel(BlockType $type, ?array $state): string
    {
        $detail = match ($type) {
            BlockType::CollectionFeed => $state['collection'] ?? null,
            BlockType::EpkTextSection => $state['role'] ?? null,
            default => $state['title'] ?? null,
        };

        return is_string($detail) && $detail !== '' ? $type->label().' · '.$detail : $type->label();
    }

    private static function icon(BlockType $type): Heroicon
    {
        return match ($type) {
            BlockType::HeroRotator => Heroicon::OutlinedSparkles,
            BlockType::RichTwoColumn, BlockType::EpkTextSection, BlockType::EpkLiveFormat,
            BlockType::EpkProducer, BlockType::EpkBestSuited => Heroicon::OutlinedDocumentText,
            BlockType::Booking => Heroicon::OutlinedCalendarDays,
            BlockType::CollectionFeed => Heroicon::OutlinedQueueList,
            BlockType::VenuesUk, BlockType::VenuesInternational, BlockType::EpkNotableVenues => Heroicon::OutlinedMapPin,
            BlockType::SocialPanel => Heroicon::OutlinedShare,
            BlockType::Linktree => Heroicon::OutlinedLink,
            BlockType::LegalContent => Heroicon::OutlinedScale,
            BlockType::InstagramFeed, BlockType::EpkGallery => Heroicon::OutlinedPhoto,
            BlockType::ReleaseSpotlight => Heroicon::OutlinedStar,
            BlockType::CtaBanner => Heroicon::OutlinedMegaphone,
            BlockType::EpkIntro => Heroicon::OutlinedIdentification,
            BlockType::EpkReel, BlockType::EpkVideos => Heroicon::OutlinedFilm,
            BlockType::EpkIdealFor => Heroicon::OutlinedCheckBadge,
            BlockType::EpkOffers => Heroicon::OutlinedGift,
            BlockType::EpkMixes => Heroicon::OutlinedMusicalNote,
        };
    }

    /**
     * @return list<Component>
     */
    private static function schema(BlockType $type): array
    {
        return match ($type) {
            BlockType::HeroRotator => [
                TagsInput::make('styles')->label('Music styles')->reorderable()->columnSpanFull()
                    ->helperText('Shown one after another in the homepage hero.'),
            ],
            BlockType::RichTwoColumn => [
                self::title(),
                self::text('left', 'Left column'),
                self::text('right', 'Right column'),
                self::url('left_link', 'Left column link'),
                self::url('right_link', 'Right column link'),
            ],
            BlockType::Booking => [
                self::title(),
                self::text('left', 'Left column'),
                self::text('right', 'Right column'),
                self::text('success', 'Message after sending')->columnSpanFull(),
                Fieldset::make('"Book me" equipment modal')
                    ->statePath('modal')
                    ->columnSpanFull()
                    ->schema([
                        self::text('pa', 'PA system'),
                        self::text('lights', 'Lights'),
                        self::text('booth', 'DJ booth'),
                        self::text('controller', 'Controller'),
                    ]),
            ],
            BlockType::CollectionFeed => [
                Select::make('collection')
                    ->options(['mixes' => 'Mixes', 'releases' => 'Releases', 'playlists' => 'Playlists', 'videos' => 'Videos'])
                    ->required()
                    ->live(),
                self::title(),
                TextInput::make('per_page')->label('Items per page')->numeric()->minValue(1)->maxValue(50)->required()->default(6),
                self::line('more_label', '"More" button label'),
                self::line('channel_id', 'YouTube channel')
                    ->visible(fn (Get $get): bool => $get('collection') === 'videos'),
            ],
            BlockType::VenuesUk => [
                self::title()->helperText('The venues themselves are edited under Venues → UK venues.'),
            ],
            BlockType::VenuesInternational => [
                self::title()->helperText('Countries, cities and clubs are edited under Venues → International countries.'),
            ],
            BlockType::SocialPanel => [
                self::title()->columnSpanFull(),
                self::text('above_icons', 'Text above the icons'),
                self::text('below_icons', 'Text below the icons'),
                self::text('subscribe', 'Subscribe text'),
                self::text('follow', 'Follow text'),
                self::url('ad_link', 'Badge link'),
                self::url('ad_image', 'Badge image URL'),
                self::line('ad_alt', 'Badge alt text'),
                self::line('yt_channel', 'YouTube channel'),
                self::line('facebook_id', 'Facebook page'),
            ],
            BlockType::Linktree => [
                MediaUpload::image('hero_media_id')->label('Header image')->imageEditor()->columnSpanFull(),
                self::title(),
                self::line('teaser', 'Teaser'),
                ColorPicker::make('page_bg')->label('Background colour')->regex('/^#[0-9A-Fa-f]{6}$/'),
                ColorPicker::make('font_color')->label('Text colour')->regex('/^#[0-9A-Fa-f]{6}$/'),
                Select::make('font_position')->label('Text alignment')->options(['left' => 'Left', 'center' => 'Centre', 'right' => 'Right']),
            ],
            BlockType::LegalContent => [
                RichEditor::make('html')->label('Content')->columnSpanFull(),
            ],
            BlockType::InstagramFeed => [
                self::title(),
                TextInput::make('limit')->label('Posts')->numeric()->minValue(1)->maxValue(12)->required()->default(3),
            ],
            BlockType::ReleaseSpotlight => [
                self::title(),
                Select::make('release_id')
                    ->label('Release')
                    ->options(fn (): array => Release::query()->latest('published_at')->pluck('title', 'id')->all())
                    ->searchable()
                    ->required(),
                self::text('text', 'Text')->columnSpanFull(),
            ],
            BlockType::CtaBanner => [
                self::title(),
                self::line('button_label', 'Button label'),
                self::text('text', 'Text'),
                self::url('button_url', 'Button link'),
                MediaUpload::image('image_media_id')->label('Background image')->imageEditor()->columnSpanFull(),
            ],
            BlockType::EpkIntro => [
                MediaUpload::image('insta_stats_media_id', 'epk')->label('Instagram stats image')->columnSpanFull(),
                self::line('insta_stats_alt', 'Stats image alt text')->columnSpanFull(),
                self::line('email_label', 'Email label'),
                self::line('email_text', 'Email address'),
                self::line('whatsapp_label', 'WhatsApp label'),
                self::line('whatsapp_text', 'WhatsApp number'),
                self::line('socials_label', 'Socials label'),
                self::url('socials_url', 'Socials link'),
                self::line('website_label', 'Website label'),
            ],
            BlockType::EpkReel => [
                self::title(),
                self::line('cta', 'Button label'),
                self::url('url', 'Reel video URL'),
                MediaUpload::image('image_media_id', 'epk')->label('Reel poster image'),
                self::text('intro_a', 'Intro (first paragraph)'),
                self::text('intro_b', 'Intro (second paragraph)'),
            ],
            BlockType::EpkGallery => [
                self::title(),
                MediaUpload::gallery('image_media_ids', 'epk')->label('Photos')->columnSpanFull(),
                self::text('text', 'Text'),
                self::text('text_b', 'Second text'),
            ],
            BlockType::EpkIdealFor => [
                self::title()->columnSpanFull(),
                Repeater::make('reasons')
                    ->simple(TextInput::make('reason')->required()->maxLength(255))
                    ->addActionLabel('Add reason')
                    ->columnSpanFull(),
            ],
            BlockType::EpkTextSection => [
                Select::make('role')
                    ->options(['tailored' => 'Tailored sets', 'renowned' => 'Renowned venues', 'worldwide' => 'Worldwide'])
                    ->required(),
                self::title(),
                self::text('text', 'Text'),
                self::text('text_b', 'Second text'),
                self::line('link_label', 'Link label'),
                self::url('link_url', 'Link'),
            ],
            BlockType::EpkOffers => [
                self::title()->columnSpanFull(),
                Repeater::make('items')
                    ->label('Offers')
                    ->maxItems(6)
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                    ->addActionLabel('Add offer')
                    ->columnSpanFull()
                    ->schema([
                        self::line('title', 'Offer'),
                        self::text('text', 'Text'),
                        self::text('text_b', 'Second text'),
                    ]),
                self::line('songs_by', '"Songs by" label'),
                self::line('listen_here_1', '"Listen here" label 1'),
                self::line('listen_here_2', '"Listen here" label 2'),
                Fieldset::make('DJ setup')
                    ->statePath('setup')
                    ->columnSpanFull()
                    ->schema([
                        MediaUpload::image('image_media_id', 'epk')->label('Setup image')->columnSpanFull(),
                        self::line('alt', 'Image alt text'),
                        self::line('cta', 'Button label'),
                        self::url('url', 'Button link'),
                    ]),
            ],
            BlockType::EpkVideos => [
                self::videoList('corporate', 'Corporate videos'),
                self::videoList('underground', 'Underground videos'),
            ],
            BlockType::EpkMixes => [
                self::title()->columnSpanFull(),
                Repeater::make('items')
                    ->label('Mixes')
                    ->columns(2)
                    ->addActionLabel('Add mix')
                    ->columnSpanFull()
                    ->schema([
                        self::line('label', 'Label'),
                        Select::make('mix_id')
                            ->label('Mix')
                            ->options(fn (): array => Mix::query()->latest('released_at')->pluck('title', 'id')->all())
                            ->searchable()
                            ->required(),
                    ]),
            ],
            BlockType::EpkLiveFormat => [
                self::title()->columnSpanFull(),
                self::text('text', 'Text'),
                self::text('text_b', 'Second text'),
            ],
            BlockType::EpkNotableVenues => [
                self::title()->columnSpanFull(),
                self::text('text', 'Text')->columnSpanFull(),
                self::line('link_label', 'Link label'),
                self::url('link_url', 'Link'),
            ],
            BlockType::EpkProducer => [
                self::title()->columnSpanFull(),
                self::text('text', 'Text')->columnSpanFull(),
                Repeater::make('groups')
                    ->label('Track lists')
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => strip_tags((string) ($state['title'] ?? '')) ?: null)
                    ->addActionLabel('Add track list')
                    ->columnSpanFull()
                    ->schema([
                        self::line('title', 'List title')->helperText('e.g. "Previous releases". Line breaks: <br />'),
                        Repeater::make('items')
                            ->label('Tracks')
                            ->columns(3)
                            ->addActionLabel('Add track')
                            ->schema([
                                self::line('label', 'Title'),
                                self::url('url', 'Link (Spotify, SoundCloud…)'),
                                self::url('image_url', 'Cover image URL'),
                            ]),
                    ]),
            ],
            BlockType::EpkBestSuited => [
                self::title()->columnSpanFull(),
                self::text('text', 'Text'),
                self::text('text_b', 'Second text'),
                self::text('text_c', 'Third text')->columnSpanFull(),
            ],
        };
    }

    private static function videoList(string $statePath, string $label): Fieldset
    {
        return Fieldset::make($label)
            ->statePath($statePath)
            ->columnSpanFull()
            ->schema([
                self::title()->columnSpanFull(),
                Repeater::make('items')
                    ->label('Videos')
                    ->collapsible()
                    ->columns(2)
                    ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                    ->addActionLabel('Add video')
                    ->columnSpanFull()
                    ->schema([
                        self::line('label', 'Label'),
                        self::url('url', 'Video URL'),
                        self::line('alt', 'Alt text'),
                        MediaUpload::image('image_media_id', 'epk')->label('Thumbnail'),
                    ]),
            ]);
    }

    private static function title(): TextInput
    {
        return self::line('title', 'Title');
    }

    private static function line(string $name, string $label): TextInput
    {
        return TextInput::make($name)->label($label)->maxLength(255);
    }

    private static function url(string $name, string $label): TextInput
    {
        return TextInput::make($name)->label($label)->maxLength(512);
    }

    private static function text(string $name, string $label): Textarea
    {
        return Textarea::make($name)->label($label)->rows(4)->autosize();
    }
}
