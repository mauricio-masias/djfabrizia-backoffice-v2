<?php

namespace App\Import\Wordpress\Steps;

use App\Import\Wordpress\ImportContext;
use App\Import\Wordpress\Meta;
use App\Import\Wordpress\Publishing;
use Djfabrizia\Content\Enums\CoverSource;
use Djfabrizia\Content\Enums\ReleasePlatform;
use Djfabrizia\Content\Models\Release;
use Djfabrizia\Content\Models\ReleaseLink;
use Djfabrizia\Content\Taxonomy\GenreResolver;
use Djfabrizia\Content\Taxonomy\RecordLabelResolver;

/**
 * Releases, their store links, and the "Style | Label | Year" description split
 * into a primary genre, a record label and a year.
 */
class ReleasesStep implements ImportStep
{
    public function __construct(
        private readonly GenreResolver $genres,
        private readonly RecordLabelResolver $labels,
    ) {}

    public function name(): string
    {
        return 'releases';
    }

    public function run(ImportContext $context): void
    {
        foreach ($context->source->posts('releases') as $post) {
            $meta = $context->source->meta($post->ID);
            $description = $meta->get('release_description');
            [$style, $label, $year] = array_map('trim', array_pad(explode('|', (string) $description), 3, ''));
            $genre = $this->genres->resolve($style);

            $release = Release::query()->updateOrCreate(['legacy_wp_id' => $post->ID], [
                'title' => $post->post_title,
                'cover_source' => $meta->get('release_cover_art') === 'local' ? CoverSource::Local : CoverSource::Remote,
                'cover_media_id' => $context->idFor('media', $meta->get('release_cover_art_local')),
                'cover_external_url' => $meta->get('release_cover_art_external') ?: null,
                'track_media_id' => $context->idFor('media', $meta->get('release_track')),
                'duration' => $meta->get('release_time'),
                'bpm' => $meta->get('release_bpm'),
                'record_label_id' => $this->labels->resolve($label)?->id,
                'primary_genre_id' => $genre?->id,
                'year' => ctype_digit($year) ? (int) $year : null,
                'legacy_description' => $description,
                ...Publishing::of($post),
            ]);

            $release->genres()->sync($genre === null ? [] : [$genre->id]);
            $this->importLinks($release, $meta, $post->ID);

            $context->saved($this->name(), $release);
        }
    }

    private function importLinks(Release $release, Meta $meta, int $postId): void
    {
        $keys = [];

        foreach (ReleasePlatform::cases() as $sort => $platform) {
            $url = $meta->get("release_{$platform->value}_link");

            if ($url === null || trim($url) === '') {
                continue;
            }

            $keys[] = $key = "{$postId}:{$platform->value}";

            ReleaseLink::query()->updateOrCreate(['legacy_key' => $key], [
                'release_id' => $release->id,
                'platform' => $platform,
                'label' => $meta->get("release_{$platform->value}_label"),
                'url' => trim($url),
                'sort' => $sort,
            ]);
        }

        $release->links()->whereNotNull('legacy_key')->whereNotIn('legacy_key', $keys)->delete();
    }
}
