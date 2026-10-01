<?php

namespace App\Filament\Forms;

use App\Media\MediaStorage;
use Djfabrizia\Content\Models\Media;
use Filament\Forms\Components\FileUpload;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

/**
 * A FileUpload whose state is Media IDs instead of file paths.
 *
 * Uploading creates a Media row (and queues its webp variants); removing a file
 * only detaches it, because the same Media row can be used elsewhere.
 */
final class MediaUpload
{
    /** SVG is not accepted: it can carry scripts and is served from our own origin. */
    public const IMAGE_TYPES = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];

    public const AUDIO_TYPES = ['audio/mpeg', 'audio/mp3', 'audio/wav', 'audio/x-wav'];

    /** Max upload size for images, in kilobytes. */
    public const IMAGE_MAX_KB = 10_240;

    /** Max upload size for audio tracks, in kilobytes. */
    public const AUDIO_MAX_KB = 51_200;

    public static function image(string $name, string $directory = 'media'): FileUpload
    {
        return self::base($name, $directory)
            ->image()
            ->acceptedFileTypes(self::IMAGE_TYPES)
            ->maxSize(self::IMAGE_MAX_KB);
    }

    public static function gallery(string $name, string $directory = 'media'): FileUpload
    {
        return self::image($name, $directory)
            ->multiple()
            ->reorderable()
            ->panelLayout('grid');
    }

    public static function audio(string $name): FileUpload
    {
        return self::base($name, 'tracks')
            ->acceptedFileTypes(self::AUDIO_TYPES)
            ->maxSize(self::AUDIO_MAX_KB);
    }

    private static function base(string $name, string $directory): FileUpload
    {
        return FileUpload::make($name)
            ->disk(MediaStorage::DISK)
            ->fetchFileInformation(false)
            ->saveUploadedFileUsing(
                fn (TemporaryUploadedFile $file): string => (string) app(MediaStorage::class)->store($file, $directory)->id,
            )
            ->getUploadedFileUsing(function (string $file): ?array {
                $media = is_numeric($file) ? Media::query()->find((int) $file) : null;

                return $media === null ? null : [
                    'name' => basename($media->path),
                    'size' => $media->size ?? 0,
                    'type' => $media->mime,
                    'url' => $media->url(),
                ];
            })
            ->deleteUploadedFileUsing(static fn (): null => null)
            ->dehydrateStateUsing(static fn (mixed $state): mixed => self::toIds($state));
    }

    /**
     * Livewire keeps file state as strings; store real integers.
     */
    private static function toIds(mixed $state): mixed
    {
        if (is_array($state)) {
            return array_values(array_map('intval', array_filter($state, 'is_numeric')));
        }

        return is_numeric($state) ? (int) $state : null;
    }
}
