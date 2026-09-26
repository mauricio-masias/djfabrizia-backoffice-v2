<?php

namespace App\Import\Wordpress\Steps;

use App\Import\Wordpress\ImportContext;
use App\Import\Wordpress\Publishing;
use Djfabrizia\Content\Enums\ContentSource;
use Djfabrizia\Content\Models\Video;

class VideosStep implements ImportStep
{
    public function name(): string
    {
        return 'videos';
    }

    public function run(ImportContext $context): void
    {
        $seen = [];

        foreach ($context->source->posts('videos') as $post) {
            $meta = $context->source->meta($post->ID);
            $youtubeId = trim((string) $meta->get('video_id'));

            if ($youtubeId === '' || isset($seen[$youtubeId])) {
                $context->skipped($this->name(), "video {$post->ID} has no or a duplicate YouTube ID ({$youtubeId})");

                continue;
            }

            $seen[$youtubeId] = true;

            $video = Video::query()->updateOrCreate(['legacy_wp_id' => $post->ID], [
                'youtube_id' => $youtubeId,
                'title' => $meta->get('video_title') ?: $post->post_title,
                'duration' => $meta->get('video_time'),
                'source' => ContentSource::Youtube,
                ...Publishing::of($post),
            ]);

            $context->saved($this->name(), $video);
        }
    }
}
