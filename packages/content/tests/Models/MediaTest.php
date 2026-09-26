<?php

namespace Djfabrizia\Content\Tests\Models;

use Djfabrizia\Content\Models\Media;
use Tests\TestCase;

class MediaTest extends TestCase
{
    public function test_urls_use_the_configured_media_base_url(): void
    {
        config(['content.media_url' => 'https://backoffice.example.com/storage/']);
        $media = Media::factory()->state(['path' => 'media/2024/05/shot.jpg'])->withVariants()->make();

        $this->assertSame('https://backoffice.example.com/storage/media/2024/05/shot.jpg', $media->url());
        $this->assertSame(
            'https://backoffice.example.com/storage/media/2024/05/shot-400.webp 400w, '
            .'https://backoffice.example.com/storage/media/2024/05/shot-800.webp 800w, '
            .'https://backoffice.example.com/storage/media/2024/05/shot-1600.webp 1600w',
            $media->srcset(),
        );
    }

    public function test_urls_fall_back_to_the_public_disk(): void
    {
        config(['content.media_url' => null, 'filesystems.disks.public.url' => 'http://localhost:6060/storage']);

        $media = Media::factory()->make(['path' => 'media/x.jpg']);

        $this->assertSame('http://localhost:6060/storage/media/x.jpg', $media->url());
        $this->assertNull($media->srcset());
    }

    public function test_legacy_path_prefers_the_wordpress_path(): void
    {
        $imported = Media::factory()->make(['path' => 'media/2024/03/a.jpg', 'legacy_path' => '2024/03/a.jpg']);
        $uploaded = Media::factory()->make(['path' => 'media/2026/09/b.jpg', 'legacy_path' => null]);

        $this->assertSame('2024/03/a.jpg', $imported->legacyPath());
        $this->assertSame('media/2026/09/b.jpg', $uploaded->legacyPath());
    }
}
