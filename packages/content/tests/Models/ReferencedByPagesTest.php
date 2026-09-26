<?php

namespace Djfabrizia\Content\Tests\Models;

use Djfabrizia\Content\Blocks\BlockType;
use Djfabrizia\Content\Exceptions\ReferencedContentException;
use Djfabrizia\Content\Models\Media;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Page;
use Djfabrizia\Content\Models\Release;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class ReferencedByPagesTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_a_mix_used_by_a_page_block_cannot_be_deleted(): void
    {
        $mix = Mix::factory()->create();
        Page::factory()->create([
            'slug' => 'epk-en',
            'blocks' => [['type' => BlockType::EpkMixes->value, 'data' => ['items' => [['mix_id' => $mix->id]]]]],
        ]);

        try {
            $mix->delete();
            $this->fail('Expected the delete to be refused.');
        } catch (ReferencedContentException $exception) {
            $this->assertStringContainsString('epk-en', $exception->getMessage());
        }

        $this->assertModelExists($mix);
    }

    public function test_media_used_by_a_page_block_cannot_be_deleted(): void
    {
        $media = Media::factory()->create();
        Page::factory()->create([
            'blocks' => [['type' => BlockType::EpkGallery->value, 'data' => ['image_media_ids' => [$media->id]]]],
        ]);

        $this->expectException(ReferencedContentException::class);

        $media->delete();
    }

    public function test_a_release_in_a_spotlight_block_cannot_be_deleted(): void
    {
        $release = Release::factory()->create();
        Page::factory()->create([
            'blocks' => [['type' => BlockType::ReleaseSpotlight->value, 'data' => ['release_id' => $release->id]]],
        ]);

        $this->expectException(ReferencedContentException::class);

        $release->delete();
    }

    public function test_unreferenced_content_is_deleted(): void
    {
        $mix = Mix::factory()->create();
        $other = Mix::factory()->create();
        Page::factory()->create([
            'blocks' => [['type' => BlockType::EpkMixes->value, 'data' => ['items' => [['mix_id' => $other->id]]]]],
        ]);

        $mix->delete();

        $this->assertModelMissing($mix);
    }

    public function test_deleting_cover_media_nulls_the_release_cover(): void
    {
        $release = Release::factory()->withLocalCover()->create();

        $release->coverMedia?->delete();

        $this->assertNull($release->fresh()?->cover_media_id);
    }
}
