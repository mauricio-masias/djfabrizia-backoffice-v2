<?php

namespace App\Jobs;

use Djfabrizia\Content\Models\Media;
use GdImage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

/**
 * Writes webp copies of an image at a few widths, for responsive `srcset`.
 * Widths larger than the original are skipped (no upscaling).
 */
class GenerateMediaVariants implements ShouldQueue
{
    use Queueable;

    public const WIDTHS = [400, 800, 1600];

    private const QUALITY = 80;

    public int $tries = 3;

    public int $timeout = 120;

    /** @var list<int> */
    public array $backoff = [10, 60, 300];

    public function __construct(public readonly int $mediaId) {}

    public function handle(): void
    {
        $media = Media::query()->find($this->mediaId);

        if ($media === null) {
            return;
        }

        $disk = Storage::disk($media->disk);
        $source = @imagecreatefromstring((string) $disk->get($media->path));

        if (! $source instanceof GdImage) {
            Log::warning('Media variants skipped: not a readable image', ['media_id' => $media->id]);

            return;
        }

        $variants = [];
        $originalWidth = imagesx($source);
        $base = preg_replace('/\.[^.\/]+$/', '', $media->path);

        foreach (self::WIDTHS as $width) {
            if ($width >= $originalWidth) {
                continue;
            }

            $resized = imagescale($source, $width);

            if (! $resized instanceof GdImage) {
                continue;
            }

            ob_start();
            imagewebp($resized, null, self::QUALITY);
            $disk->put($path = "{$base}-{$width}.webp", (string) ob_get_clean());
            imagedestroy($resized);

            $variants[$width] = $path;
        }

        imagedestroy($source);

        $media->update(['variants' => $variants === [] ? null : $variants]);
    }

    public function failed(Throwable $exception): void
    {
        Log::error('Media variants failed', ['media_id' => $this->mediaId, 'error' => $exception->getMessage()]);
    }
}
