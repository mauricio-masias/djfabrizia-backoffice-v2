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

    /**
     * GD decodes the whole bitmap (about 4 bytes per pixel plus overhead):
     * 25 MP is roughly 100 MB, the most a shared-hosting worker can take.
     */
    public const MAX_PIXELS = 25_000_000;

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
        $contents = (string) $disk->get($media->path);

        if (self::tooLarge($media->width, $media->height) || self::tooLarge(...self::dimensions($contents))) {
            Log::warning('Media variants skipped: image too large to resize safely', ['media_id' => $media->id, 'width' => $media->width, 'height' => $media->height]);
            $media->update(['variants' => null]);

            return;
        }

        $source = @imagecreatefromstring($contents);

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

    private static function tooLarge(?int $width, ?int $height): bool
    {
        return $width !== null && $height !== null && $width * $height > self::MAX_PIXELS;
    }

    /**
     * @return array{0: int|null, 1: int|null}
     */
    private static function dimensions(string $contents): array
    {
        $size = @getimagesizefromstring($contents);

        return $size === false ? [null, null] : [$size[0], $size[1]];
    }

    public function failed(Throwable $exception): void
    {
        Log::error('Media variants failed', ['media_id' => $this->mediaId, 'error' => $exception->getMessage()]);
    }
}
