<?php

namespace Tests\Feature;

use App\Jobs\GenerateMediaVariants;
use App\Media\MediaStorage;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaStorageTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_storing_an_image_records_it_and_queues_its_variants(): void
    {
        Storage::fake('public');
        Queue::fake();

        $media = app(MediaStorage::class)->store(UploadedFile::fake()->image('Shot 1.jpg', 2000, 1000), 'epk', 'Headshot');

        Storage::disk('public')->assertExists($media->path);
        $this->assertStringStartsWith('epk/'.now()->format('Y/m').'/shot-1-', $media->path);
        $this->assertSame([2000, 1000, 'Headshot'], [$media->width, $media->height, $media->alt]);
        Queue::assertPushed(GenerateMediaVariants::class, fn (GenerateMediaVariants $job): bool => $job->mediaId === $media->id);
    }

    public function test_audio_files_get_no_image_variants(): void
    {
        Storage::fake('public');
        Queue::fake();

        $media = app(MediaStorage::class)->store(UploadedFile::fake()->create('track.mp3', 500, 'audio/mpeg'), 'tracks');

        $this->assertSame('audio/mpeg', $media->mime);
        Queue::assertNotPushed(GenerateMediaVariants::class);
    }

    public function test_variants_are_webp_and_never_upscaled(): void
    {
        Storage::fake('public');
        Queue::fake();
        $media = app(MediaStorage::class)->store(UploadedFile::fake()->image('wide.jpg', 1000, 500));

        (new GenerateMediaVariants($media->id))->handle();

        $media->refresh();
        $this->assertSame([400, 800], array_keys($media->variants ?? []));
        Storage::disk('public')->assertExists($media->variants[400]);
        $this->assertStringEndsWith('-400.webp', $media->variants[400]);
    }

    public function test_a_file_that_is_not_an_image_is_skipped(): void
    {
        Storage::fake('public');
        Queue::fake();
        $media = app(MediaStorage::class)->store(UploadedFile::fake()->create('notes.txt', 1, 'text/plain'));

        (new GenerateMediaVariants($media->id))->handle();

        $this->assertNull($media->fresh()?->variants);
    }
}
