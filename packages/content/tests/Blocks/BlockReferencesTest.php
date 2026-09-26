<?php

namespace Djfabrizia\Content\Tests\Blocks;

use Djfabrizia\Content\Blocks\BlockReferences;
use Djfabrizia\Content\Blocks\BlockType;
use PHPUnit\Framework\TestCase;

class BlockReferencesTest extends TestCase
{
    public function test_it_collects_ids_from_nested_wildcard_paths_grouped_by_kind(): void
    {
        $blocks = [
            ['type' => BlockType::EpkVideos->value, 'data' => [
                'corporate' => ['title' => 'Corporate', 'items' => [['image_media_id' => 4], ['image_media_id' => 5]]],
                'underground' => ['title' => 'Underground', 'items' => [['image_media_id' => 5]]],
            ]],
            ['type' => BlockType::EpkGallery->value, 'data' => ['image_media_ids' => [7, 8]]],
            ['type' => BlockType::EpkMixes->value, 'data' => ['items' => [['mix_id' => 2], ['mix_id' => '3']]]],
            ['type' => BlockType::ReleaseSpotlight->value, 'data' => ['release_id' => 9]],
        ];

        $ids = BlockReferences::collect($blocks);

        $this->assertSame([4, 5, 7, 8], $ids['media']);
        $this->assertSame([2, 3], $ids['mixes']);
        $this->assertSame([9], $ids['releases']);
    }

    public function test_it_ignores_unknown_types_empty_values_and_malformed_blocks(): void
    {
        $ids = BlockReferences::collect([
            ['type' => 'retired_block', 'data' => ['image_media_id' => 1]],
            ['type' => BlockType::EpkReel->value, 'data' => ['image_media_id' => null]],
            ['type' => BlockType::EpkReel->value],
            ['data' => ['image_media_id' => 3]],
        ]);

        $this->assertSame(['media' => [], 'mixes' => [], 'releases' => []], $ids);
    }
}
