<?php

namespace App\Media;

use App\Jobs\GenerateMediaVariants;
use Djfabrizia\Content\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Stores uploaded files on the public disk and records them as Media rows.
 */
class MediaStorage
{
    public const DISK = 'public';

    /** Image types that get resized webp variants. */
    private const VARIANT_MIMES = ['image/jpeg', 'image/png', 'image/webp'];

    /**
     * @param  string  $directory  top-level folder: media, tracks or epk
     */
    public function store(UploadedFile $file, string $directory = 'media', ?string $alt = null): Media
    {
        $extension = strtolower($file->getClientOriginalExtension() ?: (string) $file->guessExtension());
        $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) ?: 'file';
        $path = $file->storeAs(
            $directory.'/'.now()->format('Y/m'),
            $name.'-'.Str::lower(Str::random(6)).'.'.$extension,
            self::DISK,
        );

        if ($path === false) {
            throw new \RuntimeException('Could not store the uploaded file.');
        }

        return $this->record($path, $file->getMimeType(), $alt);
    }

    /**
     * Records a file that is already on the public disk (used by the importer).
     */
    public function record(string $path, ?string $mime = null, ?string $alt = null, ?string $legacyPath = null, ?int $legacyWordpressId = null): Media
    {
        $disk = Storage::disk(self::DISK);
        $mime ??= $disk->mimeType($path) ?: null;
        [$width, $height] = $this->dimensions($disk->path($path));

        $attributes = [
            'disk' => self::DISK,
            'path' => $path,
            'legacy_path' => $legacyPath,
            'mime' => $mime,
            'size' => $disk->size($path),
            'width' => $width,
            'height' => $height,
            'alt' => $alt,
        ];

        $media = $legacyWordpressId === null
            ? Media::query()->create($attributes)
            : Media::query()->updateOrCreate(['legacy_wp_id' => $legacyWordpressId], $attributes);

        if (in_array($mime, self::VARIANT_MIMES, true)) {
            GenerateMediaVariants::dispatch($media->id)->afterCommit();
        }

        return $media;
    }

    /**
     * @return array{0: int|null, 1: int|null}
     */
    private function dimensions(string $absolutePath): array
    {
        $size = @getimagesize($absolutePath);

        return $size === false ? [null, null] : [$size[0], $size[1]];
    }
}
