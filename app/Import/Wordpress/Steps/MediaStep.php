<?php

namespace App\Import\Wordpress\Steps;

use App\Import\Wordpress\ImportContext;
use App\Media\MediaStorage;
use Djfabrizia\Content\Models\Media;
use Illuminate\Support\Facades\Storage;

/**
 * Attachments → Media. Files are copied from the mounted WordPress uploads
 * folder to the public disk (media/{Y}/{m}/… or tracks/…), keeping the old
 * relative path in `legacy_path` for v1.
 */
class MediaStep implements ImportStep
{
    public function __construct(private readonly MediaStorage $storage) {}

    public function name(): string
    {
        return 'media';
    }

    public function run(ImportContext $context): void
    {
        foreach ($context->source->posts('attachment') as $post) {
            $meta = $context->source->meta($post->ID);
            $legacyPath = $meta->get('_wp_attached_file');

            if ($legacyPath === null || $legacyPath === '' || str_contains($legacyPath, '..')) {
                $context->skipped($this->name(), "attachment {$post->ID} has no usable file path");

                continue;
            }

            $source = rtrim($context->uploadsPath, '/').'/'.$legacyPath;
            $target = str_starts_with($legacyPath, 'tracks/') ? $legacyPath : 'media/'.$legacyPath;
            $alt = $meta->get('_wp_attachment_image_alt');

            if ($context->dryRun || ! is_file($source)) {
                // Keep the row (and every reference to it) even when the file is
                // not in this copy of the uploads; cms:verify-import reports it.
                if (! $context->dryRun) {
                    $context->warn("[media] attachment {$post->ID}: file missing ({$legacyPath}); recorded without the file");
                }

                $media = Media::query()->updateOrCreate(
                    ['legacy_wp_id' => $post->ID],
                    ['path' => $target, 'legacy_path' => $legacyPath, 'mime' => $post->post_mime_type ?: null, 'alt' => $alt],
                );
            } else {
                $this->copy($source, $target);
                $media = $this->storage->record($target, $post->post_mime_type ?: null, $alt, $legacyPath, $post->ID);
            }

            $context->remember('media', $post->ID, $media->id);
            $context->saved($this->name(), $media);
        }
    }

    private function copy(string $source, string $target): void
    {
        $disk = Storage::disk(MediaStorage::DISK);

        if ($disk->exists($target) && $disk->size($target) === filesize($source)) {
            return;
        }

        $stream = fopen($source, 'rb');

        if ($stream === false) {
            throw new \RuntimeException("Cannot read {$source}");
        }

        $disk->writeStream($target, $stream);

        if (is_resource($stream)) {
            fclose($stream);
        }
    }
}
