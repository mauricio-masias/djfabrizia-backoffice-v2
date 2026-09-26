<?php

namespace App\Console\Commands;

use App\Import\Wordpress\Steps\BookingsStep;
use App\Import\Wordpress\WordpressSource;
use Djfabrizia\Content\Blocks\BlockReferences;
use Djfabrizia\Content\Legacy\WordpressPages;
use Djfabrizia\Content\Models\Booking;
use Djfabrizia\Content\Models\Country;
use Djfabrizia\Content\Models\Link;
use Djfabrizia\Content\Models\LinkSection;
use Djfabrizia\Content\Models\Media;
use Djfabrizia\Content\Models\Menu;
use Djfabrizia\Content\Models\MenuItem;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Page;
use Djfabrizia\Content\Models\Playlist;
use Djfabrizia\Content\Models\Release;
use Djfabrizia\Content\Models\SocialLink;
use Djfabrizia\Content\Models\UkVenue;
use Djfabrizia\Content\Models\Video;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

/**
 * Compares WordPress with the imported content: row counts per entity, page
 * blocks pointing at missing content, and media files missing on disk.
 * Exits with a failure code on any mismatch.
 */
class VerifyImport extends Command
{
    protected $signature = 'cms:verify-import
        {--allow-missing-files : Report media files missing on disk as warnings (local copies without every upload)}';

    protected $description = 'Check the WordPress import: counts, orphans and files';

    public function handle(WordpressSource $wordpress): int
    {
        $rows = [];
        $failed = false;

        foreach ($this->counts($wordpress) as $entity => [$expected, $actual]) {
            $ok = $expected === $actual;
            $failed = $failed || ! $ok;
            $rows[] = [$entity, $expected, $actual, $ok ? 'OK' : 'MISMATCH'];
        }

        $this->table(['Entity', 'WordPress', 'Back office', ''], $rows);

        $problems = $this->orphans();
        $missingFiles = $this->missingFiles();

        if ($this->option('allow-missing-files')) {
            foreach ($missingFiles as $missing) {
                $this->warn($missing);
            }
        } else {
            $problems = [...$problems, ...$missingFiles];
        }

        foreach ($problems as $problem) {
            $this->error($problem);
        }

        if ($failed || $problems !== []) {
            $this->error('Import verification failed.');

            return self::FAILURE;
        }

        $this->info('Import verified.');

        return self::SUCCESS;
    }

    /**
     * @return array<string, array{0: int, 1: int}>
     */
    private function counts(WordpressSource $wordpress): array
    {
        $bio = $wordpress->meta(7);
        $social = $wordpress->meta(967);
        $linktree = $wordpress->meta(1347);
        $menuCounts = [];

        foreach (WordpressPages::MENUS as $termId => $slug) {
            $menu = Menu::query()->where('slug', $slug)->first();
            $menuCounts["menu {$slug}"] = [$wordpress->menuItems($termId)->count(), $menu?->items()->count() ?? 0];
        }

        return [
            'media' => [$wordpress->posts('attachment')->count(), Media::query()->whereNotNull('legacy_wp_id')->count()],
            'mixes' => [$wordpress->posts('mixes')->count(), Mix::query()->whereNotNull('legacy_wp_id')->count()],
            'releases' => [$wordpress->posts('releases')->count(), Release::query()->whereNotNull('legacy_wp_id')->count()],
            'playlists' => [$wordpress->posts('playlists')->count(), Playlist::query()->whereNotNull('legacy_wp_id')->count()],
            'videos' => [$this->uniqueVideos($wordpress), Video::query()->whereNotNull('legacy_wp_id')->count()],
            'countries' => [$wordpress->posts('international')->count(), Country::query()->whereNotNull('legacy_wp_id')->count()],
            'uk venues' => [count($bio->matching('/^uk_venues_\d+_uk_venue$/')), UkVenue::query()->whereNotNull('legacy_key')->count()],
            'social links' => [$social->int('social_icons') ?? 0, SocialLink::query()->whereNotNull('legacy_key')->count()],
            'linktree sections' => [$linktree->int('linkt_sections') ?? 0, LinkSection::query()->whereNotNull('legacy_key')->count()],
            'linktree links' => [$linktree->int('linkt_linktree') ?? 0, Link::query()->whereNotNull('legacy_key')->count()],
            ...$menuCounts,
            'pages' => [count(WordpressPages::all()), Page::query()->whereNotNull('legacy_wp_id')->count()],
            'bookings' => [
                $wordpress->formSubmissions((int) config('cms.import.booking_form_id'))
                    ->filter(fn (object $row): bool => BookingsStep::values($row->form_value) !== null)
                    ->count(),
                Booking::query()->whereNotNull('legacy_key')->count(),
            ],
        ];
    }

    private function uniqueVideos(WordpressSource $wordpress): int
    {
        return $wordpress->posts('videos')
            ->map(fn (object $post): string => trim((string) $wordpress->meta($post->ID)->get('video_id')))
            ->filter()
            ->unique()
            ->count();
    }

    /**
     * @return list<string>
     */
    private function orphans(): array
    {
        $problems = [];

        foreach (Page::query()->get() as $page) {
            $ids = BlockReferences::collect($page->blocks);
            $missingMedia = array_diff($ids['media'], Media::query()->whereKey($ids['media'])->pluck('id')->all());
            $missingMixes = array_diff($ids['mixes'], Mix::query()->whereKey($ids['mixes'])->pluck('id')->all());

            if ($missingMedia !== [] || $missingMixes !== []) {
                $problems[] = "Page {$page->slug} references missing media [".implode(',', $missingMedia).'] or mixes ['.implode(',', $missingMixes).']';
            }
        }

        $blankMenuItems = MenuItem::query()->where('url', '')->count();

        if ($blankMenuItems > 0) {
            $problems[] = "{$blankMenuItems} menu item(s) have no link";
        }

        $unsectioned = Link::query()->doesntHave('sections')->count();

        if ($unsectioned > 0) {
            $problems[] = "{$unsectioned} linktree link(s) belong to no section";
        }

        return $problems;
    }

    /**
     * @return list<string>
     */
    private function missingFiles(): array
    {
        $problems = [];

        foreach (Media::query()->cursor() as $media) {
            if (! Storage::disk($media->disk)->exists($media->path)) {
                $problems[] = "Media #{$media->id} file missing: {$media->path}";
            }
        }

        return $problems;
    }
}
