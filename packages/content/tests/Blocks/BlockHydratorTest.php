<?php

namespace Djfabrizia\Content\Tests\Blocks;

use Djfabrizia\Content\Blocks\BlockHydrator;
use Djfabrizia\Content\Blocks\BlockType;
use Djfabrizia\Content\Enums\PageTemplate;
use Djfabrizia\Content\Models\Media;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Page;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class BlockHydratorTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_it_resolves_every_reference_with_one_query_per_kind(): void
    {
        $media = Media::factory()->count(6)->create();
        $mixes = Mix::factory()->count(5)->published()->create();

        $page = Page::factory()->template(PageTemplate::EpkDefault)->withBlocks([
            ['type' => BlockType::EpkGallery->value, 'data' => ['image_media_ids' => $media->take(4)->pluck('id')->all()]],
            ['type' => BlockType::EpkReel->value, 'data' => ['image_media_id' => $media[5]->id]],
            ['type' => BlockType::EpkMixes->value, 'data' => ['items' => $mixes->map(fn (Mix $mix): array => ['mix_id' => $mix->id])->all()]],
        ])->create();

        DB::enableQueryLog();
        $references = (new BlockHydrator)->hydrate($page);
        $queries = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertSame(2, $queries, 'media + mixes, no releases referenced');
        $this->assertTrue($references->media($media[5]->id)?->is($media[5]));
        $this->assertTrue($references->mix($mixes[2]->id)?->is($mixes[2]));
    }

    public function test_query_count_does_not_grow_with_the_number_of_references(): void
    {
        $few = Page::factory()->withBlocks([
            ['type' => BlockType::EpkGallery->value, 'data' => ['image_media_ids' => Media::factory()->count(2)->create()->pluck('id')->all()]],
        ])->create();
        $many = Page::factory()->withBlocks([
            ['type' => BlockType::EpkGallery->value, 'data' => ['image_media_ids' => Media::factory()->count(30)->create()->pluck('id')->all()]],
        ])->create();

        DB::enableQueryLog();
        (new BlockHydrator)->hydrate($few);
        $fewQueries = count(DB::getQueryLog());
        DB::flushQueryLog();
        (new BlockHydrator)->hydrate($many);
        $manyQueries = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertSame($fewQueries, $manyQueries);
    }

    public function test_missing_references_resolve_to_null(): void
    {
        $page = Page::factory()->withBlocks([
            ['type' => BlockType::EpkReel->value, 'data' => ['image_media_id' => 999]],
        ])->create();

        $references = (new BlockHydrator)->hydrate($page);

        $this->assertNull($references->media(999));
        $this->assertNull($references->mix(null));
    }

    public function test_it_runs_no_queries_when_nothing_is_referenced(): void
    {
        $page = Page::factory()->template(PageTemplate::Bio)->create();

        DB::enableQueryLog();
        (new BlockHydrator)->hydrate($page);
        $queries = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertSame(0, $queries);
    }

    public function test_unpublished_mixes_are_hidden_unless_drafts_are_asked_for(): void
    {
        $draft = Mix::factory()->draft()->create();
        $page = Page::factory()->withBlocks([
            ['type' => BlockType::EpkMixes->value, 'data' => ['items' => [['mix_id' => $draft->id]]]],
        ])->create();

        $this->assertNull((new BlockHydrator)->hydrate($page)->mix($draft->id));
        $this->assertTrue((new BlockHydrator)->hydrate($page, includeDrafts: true)->mix($draft->id)?->is($draft));
    }
}
