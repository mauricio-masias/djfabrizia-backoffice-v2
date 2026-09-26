<?php

namespace App\Console\Commands;

use App\Import\Wordpress\WordpressImporter;
use Djfabrizia\Content\Models\Booking;
use Djfabrizia\Content\Models\City;
use Djfabrizia\Content\Models\Club;
use Djfabrizia\Content\Models\Country;
use Djfabrizia\Content\Models\Genre;
use Djfabrizia\Content\Models\Link;
use Djfabrizia\Content\Models\LinkSection;
use Djfabrizia\Content\Models\Media;
use Djfabrizia\Content\Models\MenuItem;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Page;
use Djfabrizia\Content\Models\Playlist;
use Djfabrizia\Content\Models\RecordLabel;
use Djfabrizia\Content\Models\Release;
use Djfabrizia\Content\Models\ReleaseLink;
use Djfabrizia\Content\Models\SocialLink;
use Djfabrizia\Content\Models\UkVenue;
use Djfabrizia\Content\Models\Video;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ImportWordpress extends Command
{
    protected $signature = 'cms:import-wordpress
        {--only= : Comma-separated steps to run (media, mixes, releases, playlists, videos, countries, uk_venues, menus, social_links, linktree, pages, settings, bookings)}
        {--dry-run : Run everything inside a transaction and roll it back}
        {--fresh : Delete imported content first}
        {--force : Allow --fresh in production or after back office edits}';

    protected $description = 'Import content from the WordPress v1 database (idempotent)';

    /**
     * Deleted by --fresh, children before parents. Users, settings and the
     * audit tables are kept.
     *
     * @var list<class-string<Model>>
     */
    private const FRESH_ORDER = [
        Link::class, LinkSection::class, SocialLink::class, MenuItem::class, UkVenue::class,
        Club::class, City::class, Country::class, Video::class, Playlist::class, ReleaseLink::class,
        Release::class, Mix::class, Genre::class, RecordLabel::class, Page::class, Media::class, Booking::class,
    ];

    public function handle(WordpressImporter $importer): int
    {
        $only = array_values(array_filter(array_map('trim', explode(',', (string) $this->option('only')))));
        $dryRun = (bool) $this->option('dry-run');

        if ($this->option('fresh') && ! $this->freshAllowed($importer)) {
            return self::FAILURE;
        }

        if ($this->option('fresh') && ! $dryRun) {
            $this->wipe();
        }

        $context = $importer->run($only, $dryRun);

        $this->table(
            ['Step', 'Created', 'Updated', 'Unchanged', 'Skipped'],
            collect($context->stats())->map(fn (array $counts, string $step): array => [$step, ...array_values($counts)])->values()->all(),
        );

        foreach ($context->warnings() as $warning) {
            $this->warn($warning);
        }

        $this->info($dryRun ? 'Dry run: nothing was saved.' : 'Import finished. Run cms:verify-import to check it.');

        return self::SUCCESS;
    }

    private function freshAllowed(WordpressImporter $importer): bool
    {
        if ($this->option('force')) {
            return true;
        }

        if (app()->isProduction()) {
            $this->error('--fresh deletes content. Add --force to run it in production.');

            return false;
        }

        if ($importer->hasEditsSinceLastImport()) {
            $this->error('Content was edited in the back office after the last import; --fresh would delete it. Add --force to continue.');

            return false;
        }

        return true;
    }

    private function wipe(): void
    {
        DB::transaction(function (): void {
            foreach (self::FRESH_ORDER as $model) {
                // Query-builder deletes skip the model events (and the
                // page-reference guard), which is what a full wipe needs.
                $model::query()->delete();
            }
        });
    }
}
