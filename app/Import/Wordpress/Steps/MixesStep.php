<?php

namespace App\Import\Wordpress\Steps;

use App\Import\Wordpress\ImportContext;
use App\Import\Wordpress\Publishing;
use Djfabrizia\Content\Enums\ContentSource;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Taxonomy\GenreResolver;
use Illuminate\Support\Carbon;

class MixesStep implements ImportStep
{
    public function __construct(private readonly GenreResolver $genres) {}

    public function name(): string
    {
        return 'mixes';
    }

    public function run(ImportContext $context): void
    {
        foreach ($context->source->posts('mixes') as $post) {
            $meta = $context->source->meta($post->ID);
            $url = (string) $meta->get('mix_url');
            $tags = json_decode((string) $meta->get('mix_tags'), true);
            $tags = is_array($tags) ? array_values(array_filter($tags, 'is_string')) : null;
            $releasedAt = $meta->get('mix_date');

            if ($url === '') {
                $context->skipped($this->name(), "mix {$post->ID} has no Mixcloud URL");

                continue;
            }

            // Synced rows have no legacy ID; "!=" alone would skip them (NULL) and
            // the insert below would then hit the unique external_id index.
            $taken = Mix::query()
                ->where('external_id', $url)
                ->where(fn ($query) => $query->whereNull('legacy_wp_id')->orWhere('legacy_wp_id', '!=', $post->ID))
                ->exists();

            if ($taken) {
                $context->warn("[mixes] mix {$post->ID} duplicates the Mixcloud URL {$url}; imported without an external ID");
            }

            $mix = Mix::query()->updateOrCreate(['legacy_wp_id' => $post->ID], [
                'title' => $post->post_title,
                'short_name' => $meta->get('mix_short_name'),
                'url' => $url,
                'image_url' => $meta->get('mix_img'),
                'image_small_url' => $meta->get('mix_small_img'),
                'released_at' => $releasedAt ? Carbon::parse($releasedAt) : null,
                'duration' => $meta->get('mix_audio_length'),
                'source_tags' => $tags,
                'source' => ContentSource::Mixcloud,
                'external_id' => $taken ? null : $url,
                ...Publishing::of($post),
            ]);

            $mix->genres()->sync($this->genres->resolveMany($tags ?? [])->pluck('id')->all());

            $context->remember('mixes', $post->ID, $mix->id);
            $context->saved($this->name(), $mix);
        }
    }
}
