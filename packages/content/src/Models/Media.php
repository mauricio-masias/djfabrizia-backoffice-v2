<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Blocks\ReferenceKind;
use Djfabrizia\Content\Database\Factories\MediaFactory;
use Djfabrizia\Content\Models\Concerns\ReferencedByPages;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * A file on the public disk (image or audio track).
 *
 * @property int $id
 * @property string $disk
 * @property string $path
 * @property string|null $legacy_path
 * @property string|null $mime
 * @property int|null $size
 * @property int|null $width
 * @property int|null $height
 * @property string|null $alt
 * @property array<int, string>|null $variants width => path of each webp variant
 * @property int|null $legacy_wp_id
 */
class Media extends Model
{
    /** @use HasFactory<MediaFactory> */
    use HasFactory, ReferencedByPages, UsesContentConnection;

    protected $table = 'media';

    protected $fillable = [
        'disk',
        'path',
        'legacy_path',
        'mime',
        'size',
        'width',
        'height',
        'alt',
        'variants',
        'legacy_wp_id',
    ];

    protected $attributes = [
        'disk' => 'public',
    ];

    protected function casts(): array
    {
        return [
            'size' => 'integer',
            'width' => 'integer',
            'height' => 'integer',
            'variants' => 'array',
            'legacy_wp_id' => 'integer',
        ];
    }

    public static function referenceKind(): ReferenceKind
    {
        return ReferenceKind::Media;
    }

    protected static function newFactory(): MediaFactory
    {
        return MediaFactory::new();
    }

    /**
     * Absolute public URL of the original file.
     */
    public function url(): string
    {
        return $this->urlFor($this->path);
    }

    /**
     * `srcset` value built from the webp variants, or null when none exist.
     */
    public function srcset(): ?string
    {
        if (empty($this->variants)) {
            return null;
        }

        $sources = [];

        foreach ($this->variants as $width => $path) {
            $sources[] = $this->urlFor($path).' '.$width.'w';
        }

        return implode(', ', $sources);
    }

    /**
     * The path v1 has always returned: the WordPress-relative path for imported
     * files, the storage path for files uploaded after the import.
     */
    public function legacyPath(): string
    {
        return $this->legacy_path ?? $this->path;
    }

    public function isImage(): bool
    {
        return str_starts_with((string) $this->mime, 'image/');
    }

    private function urlFor(string $path): string
    {
        $base = config('content.media_url');

        if (is_string($base) && $base !== '') {
            return rtrim($base, '/').'/'.ltrim($path, '/');
        }

        return Storage::disk($this->disk)->url($path);
    }
}
