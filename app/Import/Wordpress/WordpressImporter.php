<?php

namespace App\Import\Wordpress;

use App\Import\Wordpress\Steps\BookingsStep;
use App\Import\Wordpress\Steps\CountriesStep;
use App\Import\Wordpress\Steps\ImportStep;
use App\Import\Wordpress\Steps\LinktreeStep;
use App\Import\Wordpress\Steps\MediaStep;
use App\Import\Wordpress\Steps\MenusStep;
use App\Import\Wordpress\Steps\MixesStep;
use App\Import\Wordpress\Steps\PagesStep;
use App\Import\Wordpress\Steps\PlaylistsStep;
use App\Import\Wordpress\Steps\ReleasesStep;
use App\Import\Wordpress\Steps\SettingsStep;
use App\Import\Wordpress\Steps\SocialLinksStep;
use App\Import\Wordpress\Steps\UkVenuesStep;
use App\Import\Wordpress\Steps\VideosStep;
use Djfabrizia\Content\Models\Booking;
use Djfabrizia\Content\Models\Country;
use Djfabrizia\Content\Models\Link;
use Djfabrizia\Content\Models\LinkSection;
use Djfabrizia\Content\Models\Media;
use Djfabrizia\Content\Models\MenuItem;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Page;
use Djfabrizia\Content\Models\Playlist;
use Djfabrizia\Content\Models\Release;
use Djfabrizia\Content\Models\Setting;
use Djfabrizia\Content\Models\SocialLink;
use Djfabrizia\Content\Models\UkVenue;
use Djfabrizia\Content\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Throwable;

/**
 * Runs the import steps in dependency order (media and mixes before the
 * pages and releases that reference them). Every step upserts by a legacy
 * key, so a run can be repeated safely.
 */
class WordpressImporter
{
    /** @var list<class-string<ImportStep>> */
    public const STEPS = [
        MediaStep::class,
        MixesStep::class,
        ReleasesStep::class,
        PlaylistsStep::class,
        VideosStep::class,
        CountriesStep::class,
        UkVenuesStep::class,
        MenusStep::class,
        SocialLinksStep::class,
        LinktreeStep::class,
        PagesStep::class,
        SettingsStep::class,
        BookingsStep::class,
    ];

    /**
     * Content a fresh import would overwrite if editors had changed it.
     *
     * @var list<class-string<Model>>
     */
    public const EDITABLE_MODELS = [
        Page::class, Mix::class, Release::class, Playlist::class, Video::class, Country::class,
        UkVenue::class, MenuItem::class, SocialLink::class, Link::class, LinkSection::class, Media::class,
    ];

    public function __construct(private readonly WordpressSource $source) {}

    /**
     * @return list<string>
     */
    public static function stepNames(): array
    {
        return array_map(fn (string $class): string => app($class)->name(), self::STEPS);
    }

    /**
     * @param  list<string>  $only  step names; empty runs everything
     */
    public function run(array $only = [], bool $dryRun = false): ImportContext
    {
        $unknown = array_diff($only, self::stepNames());

        if ($unknown !== []) {
            throw new InvalidArgumentException('Unknown import step(s): '.implode(', ', $unknown));
        }

        $context = new ImportContext($this->source, $dryRun, (string) config('cms.import.uploads_path'));
        $steps = array_map(fn (string $class): ImportStep => app($class), self::STEPS);

        DB::beginTransaction();

        try {
            foreach ($steps as $step) {
                if ($only === [] || in_array($step->name(), $only, true) || $this->isNeededFor($step, $only)) {
                    $step->run($context);
                }
            }

            if ($dryRun) {
                DB::rollBack();
            } else {
                Setting::put('import', 'last_run_at', now()->toIso8601String());
                DB::commit();
            }
        } catch (Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }

        return $context;
    }

    /**
     * Content changed in the back office after the last import, which a fresh
     * import would throw away.
     */
    public function hasEditsSinceLastImport(): bool
    {
        $lastRun = Setting::value('import', 'last_run_at');
        $since = is_string($lastRun) ? Carbon::parse($lastRun) : null;

        if (Booking::query()->whereNull('legacy_key')->exists()) {
            return true;
        }

        foreach (self::EDITABLE_MODELS as $model) {
            $query = $model::query();

            if ($since === null ? $query->exists() : $query->where('updated_at', '>', $since)->exists()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Steps that later steps read IDs from: running only "pages" still needs
     * the media and mix ID maps.
     *
     * @param  list<string>  $only
     */
    private function isNeededFor(ImportStep $step, array $only): bool
    {
        $needs = [
            'media' => ['releases', 'linktree', 'pages'],
            'mixes' => ['pages'],
        ];

        return array_intersect($needs[$step->name()] ?? [], $only) !== [];
    }
}
