<?php

namespace Tests\Feature\Import;

use App\Import\Wordpress\ImportContext;
use App\Import\Wordpress\WordpressImporter;
use Database\Seeders\ReferenceSeeder;
use Djfabrizia\Content\Blocks\BlockType;
use Djfabrizia\Content\Enums\BookingStatus;
use Djfabrizia\Content\Enums\CoverSource;
use Djfabrizia\Content\Enums\LinkMedia;
use Djfabrizia\Content\Enums\MenuTarget;
use Djfabrizia\Content\Enums\PublishStatus;
use Djfabrizia\Content\Enums\ReleasePlatform;
use Djfabrizia\Content\Models\Booking;
use Djfabrizia\Content\Models\Country;
use Djfabrizia\Content\Models\Genre;
use Djfabrizia\Content\Models\Link;
use Djfabrizia\Content\Models\Media;
use Djfabrizia\Content\Models\Menu;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Page;
use Djfabrizia\Content\Models\Release;
use Djfabrizia\Content\Models\SocialLink;
use Djfabrizia\Content\Models\UkVenue;
use Djfabrizia\Content\Models\Video;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\Support\WordpressFixture;
use Tests\TestCase;

class ImportWordpressTest extends TestCase
{
    use LazilyRefreshDatabase;

    private string $uploads;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        Queue::fake();

        $this->uploads = sys_get_temp_dir().'/wp-uploads-'.uniqid();
        File::ensureDirectoryExists($this->uploads.'/2024/03');
        UploadedFile::fake()->image('cyberdog.jpg', 600, 400)->move($this->uploads.'/2024/03', 'cyberdog.jpg');
        UploadedFile::fake()->image('headshot.jpg', 600, 600)->move($this->uploads.'/2024/03', 'headshot.jpg');
        config(['cms.import.uploads_path' => $this->uploads]);

        $this->seed(ReferenceSeeder::class);
        WordpressFixture::create()->sampleSite();
    }

    protected function tearDown(): void
    {
        File::deleteDirectory($this->uploads);

        parent::tearDown();
    }

    public function test_it_imports_media_and_keeps_the_wordpress_path(): void
    {
        $this->import();

        $media = Media::query()->where('legacy_wp_id', 501)->firstOrFail();
        $this->assertSame('media/2024/03/cyberdog.jpg', $media->path);
        $this->assertSame('2024/03/cyberdog.jpg', $media->legacy_path);
        $this->assertSame('At Cyberdog', $media->alt);
        $this->assertSame(600, $media->width);
        Storage::disk('public')->assertExists('media/2024/03/cyberdog.jpg');
    }

    public function test_a_missing_file_still_creates_its_media_row(): void
    {
        $context = $this->import();

        $track = Media::query()->where('legacy_wp_id', 503)->firstOrFail();
        $this->assertSame('tracks/sand.mp3', $track->path);
        $this->assertStringContainsString('file missing', implode(' ', $context->warnings()));
    }

    public function test_mixes_get_their_fields_and_normalized_genres(): void
    {
        $this->import();

        $mix = Mix::query()->with('genres')->where('legacy_wp_id', 101)->firstOrFail();
        $this->assertSame('/djfabrizia/colony-club/', $mix->url);
        $this->assertSame('/djfabrizia/colony-club/', $mix->external_id);
        $this->assertSame('63:6', $mix->duration);
        $this->assertSame(['Tech house', 'TechHouse', 'House'], $mix->source_tags);
        $this->assertSame('2014-04-19', $mix->released_at?->toDateString());
        $this->assertSame(['House', 'Tech house'], $mix->genres->pluck('name')->sort()->values()->all());
        $this->assertSame(PublishStatus::Published, $mix->status);
    }

    public function test_releases_split_the_description_and_import_store_links(): void
    {
        $this->import();

        $release = Release::query()->with(['links', 'recordLabel', 'primaryGenre', 'trackMedia'])->where('legacy_wp_id', 201)->firstOrFail();
        $this->assertSame(' Tech House | KluBasic plus | 2020', $release->legacy_description);
        $this->assertSame('KluBasic plus', $release->recordLabel?->name);
        $this->assertSame('tech-house', $release->primaryGenre?->slug);
        $this->assertSame(2020, $release->year);
        $this->assertSame(CoverSource::Remote, $release->cover_source);
        $this->assertSame('tracks/sand.mp3', $release->trackMedia?->path);
        $this->assertSame([ReleasePlatform::Spotify, ReleasePlatform::Traxsource], $release->links->pluck('platform')->all());
        $this->assertSame(1, Genre::query()->where('slug', 'tech-house')->count(), 'release style and mix tag share one genre');
    }

    public function test_videos_skip_duplicate_youtube_ids(): void
    {
        $context = $this->import();

        $this->assertSame(1, Video::query()->count());
        $this->assertSame(1, $context->stats()['videos']['skipped']);
    }

    public function test_countries_cities_clubs_and_uk_venues(): void
    {
        $this->import();

        $country = Country::query()->with('cities.clubs')->where('legacy_wp_id', 401)->firstOrFail();
        $this->assertTrue($country->is_default);
        $this->assertSame(['Milan', 'Rome'], $country->cities->pluck('name')->all());
        $this->assertSame(['Plastic', 'Magazzini'], $country->cities[0]->clubs->pluck('name')->all());
        $this->assertSame(['Hakkasan', 'Fabric', 'Ministry'], UkVenue::query()->orderBy('sort')->pluck('name')->all());
    }

    public function test_menu_items_keep_urls_targets_parents_and_icons(): void
    {
        $this->import();

        $menu = Menu::query()->where('slug', 'main')->firstOrFail();
        $items = $menu->items()->get()->keyBy('legacy_wp_id');

        $this->assertSame('#', $items[14]->url);
        $this->assertSame('http://bio', $items[1008]->url);
        $this->assertSame($items[14]->id, $items[1008]->parent_id);
        $this->assertSame(MenuTarget::Blank, $items[1009]->target);
        $this->assertSame('instagram', $items[1009]->icon);
    }

    public function test_social_links_and_linktree(): void
    {
        $this->import();

        $this->assertSame(['Instagram', 'Spotify'], SocialLink::query()->orderBy('sort')->pluck('network')->all());

        $gig = Link::query()->with(['sections', 'image'])->where('legacy_key', '1347:link:0')->firstOrFail();
        $this->assertSame(LinkMedia::Custom, $gig->media);
        $this->assertSame('2024/03/cyberdog.jpg', $gig->image?->legacy_path);
        $this->assertSame(['RECENT GIGS'], $gig->sections->pluck('label')->all());

        $spotify = Link::query()->where('legacy_key', '1347:link:1')->firstOrFail();
        $this->assertSame(LinkMedia::SpotifyCustom, $spotify->media);
        $this->assertSame(2, $spotify->sections()->count());
    }

    public function test_pages_get_blocks_for_their_template(): void
    {
        $this->import();

        $home = Page::query()->where('slug', 'home')->firstOrFail();
        $this->assertSame(['House', 'Techno'], $home->firstBlock(BlockType::HeroRotator)['styles'] ?? null);
        $this->assertSame(9, $home->firstBlock(BlockType::CollectionFeed, 'collection', 'mixes')['per_page'] ?? null);
        $this->assertSame('Big PA', $home->firstBlock(BlockType::Booking)['modal']['pa'] ?? null);

        $linktree = Page::query()->where('slug', 'linktree')->firstOrFail();
        $this->assertSame('center', $linktree->firstBlock(BlockType::Linktree)['font_position'] ?? null);

        $privacy = Page::query()->where('slug', 'privacy-policy')->firstOrFail();
        $this->assertSame('<p>Privacy</p>', $privacy->firstBlock(BlockType::LegalContent)['html'] ?? null);
    }

    public function test_epk_fields_land_in_the_blocks_of_each_variant(): void
    {
        $this->import();

        $default = Page::query()->where('slug', 'epk-en')->firstOrFail();
        $this->assertSame('Tailored sets', $default->firstBlock(BlockType::EpkTextSection, 'role', 'tailored')['title'] ?? null);
        $this->assertSame('Producer', $default->firstBlock(BlockType::EpkOffers)['items'][3]['title'] ?? null);
        $this->assertSame([['label' => 'Latest', 'mix_id' => Mix::query()->where('legacy_wp_id', 101)->value('id')]], $default->firstBlock(BlockType::EpkMixes)['items'] ?? null);
        $this->assertSame(Media::query()->where('legacy_wp_id', 502)->value('id'), $default->firstBlock(BlockType::EpkReel)['image_media_id'] ?? null);

        $underground = Page::query()->where('slug', 'epk-en-underground')->firstOrFail();
        $this->assertSame('Tailored sets', $underground->firstBlock(BlockType::EpkLiveFormat)['title'] ?? null);
        $this->assertSame('Producer', $underground->firstBlock(BlockType::EpkProducer)['title'] ?? null);
        $this->assertNull($underground->firstBlock(BlockType::EpkOffers), 'underground pages have no offers block');
    }

    public function test_only_booking_form_submissions_are_imported_without_instantiating_objects(): void
    {
        $this->import();

        $booking = Booking::query()->where('legacy_key', 'cfdb7:1')->firstOrFail();
        $this->assertSame(['Michael', 'michael@example.com', BookingStatus::Read], [$booking->name, $booking->email, $booking->status]);
        $this->assertSame('2025-01-02 03:04:05', $booking->created_at->toDateTimeString());
        $this->assertSame(1, Booking::query()->count(), 'T-shirt competition entries and unreadable rows are skipped');
    }

    public function test_a_second_run_changes_nothing(): void
    {
        $this->import();

        $stats = $this->import()->stats();

        foreach ($stats as $step => $counts) {
            $this->assertSame(0, $counts['created'], "{$step} created rows on the second run");
            $this->assertSame(0, $counts['updated'], "{$step} updated rows on the second run");
        }
    }

    public function test_a_dry_run_saves_nothing(): void
    {
        $context = app(WordpressImporter::class)->run(dryRun: true);

        $this->assertGreaterThan(0, $context->stats()['mixes']['created']);
        $this->assertSame(0, Mix::query()->count());
        Storage::disk('public')->assertMissing('media/2024/03/cyberdog.jpg');
    }

    public function test_only_runs_the_requested_steps_and_their_dependencies(): void
    {
        app(WordpressImporter::class)->run(['pages']);

        $this->assertSame(0, Video::query()->count());
        $this->assertGreaterThan(0, Media::query()->count(), 'pages need the media ID map');
        $this->assertGreaterThan(0, Mix::query()->count(), 'EPK pages need the mix ID map');
    }

    public function test_the_command_refuses_a_fresh_import_after_back_office_edits(): void
    {
        $this->artisan('cms:import-wordpress')->assertSuccessful();
        $this->travel(1)->minute();
        Mix::query()->firstOrFail()->update(['short_name' => 'Edited in the back office']);

        $this->artisan('cms:import-wordpress --fresh')->assertFailed();
        $this->assertSame(1, Mix::query()->where('short_name', 'Edited in the back office')->count());

        $this->artisan('cms:import-wordpress --fresh --force')->assertSuccessful();
    }

    public function test_verify_passes_after_an_import_and_fails_on_a_mismatch(): void
    {
        $this->artisan('cms:import-wordpress')->assertSuccessful();

        $this->artisan('cms:verify-import --allow-missing-files')->assertSuccessful();
        $this->artisan('cms:verify-import')->assertFailed();

        Video::query()->delete();
        $this->artisan('cms:verify-import --allow-missing-files')->assertFailed();
    }

    private function import(): ImportContext
    {
        return app(WordpressImporter::class)->run();
    }
}
