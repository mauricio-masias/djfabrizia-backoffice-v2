<?php

namespace Tests\Integration;

use Database\Seeders\DatabaseSeeder;
use Djfabrizia\Content\Blocks\BlockHydrator;
use Djfabrizia\Content\Blocks\BlockType;
use Djfabrizia\Content\Models\Genre;
use Djfabrizia\Content\Models\Media;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Page;
use Djfabrizia\Content\Taxonomy\GenreResolver;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Group;

#[Group('integration')]
class ContentSchemaTest extends IntegrationTestCase
{
    use RefreshDatabase;

    public function test_it_runs_on_mariadb(): void
    {
        $this->assertSame('mysql', DB::connection()->getDriverName());
        $this->assertSame('djfabriz_cms_test', DB::connection()->getDatabaseName());
    }

    public function test_the_full_seed_runs_on_mariadb(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertSame(12, Page::query()->published()->count());
        $this->assertSame(40, Mix::query()->published()->count());
    }

    public function test_page_blocks_round_trip_unicode_and_nested_json(): void
    {
        $blocks = [['type' => BlockType::RichTwoColumn->value, 'data' => [
            'title' => 'Chi sono — “DJ” & Producer',
            'left' => "Riga uno\r\n\r\nRiga due",
            'right' => '<p>Resident at <a href="https://example.com">Hakkasan</a></p>',
        ]]];

        $page = Page::factory()->withBlocks($blocks)->create();

        $this->assertSame($blocks, $page->fresh()?->blocks);
    }

    public function test_genre_slugs_are_unique_regardless_of_case(): void
    {
        Genre::factory()->create(['name' => 'House', 'slug' => 'house']);

        $this->expectException(QueryException::class);

        Genre::factory()->create(['name' => 'HOUSE', 'slug' => 'HOUSE']);
    }

    public function test_the_genre_resolver_normalizes_on_mariadb(): void
    {
        $resolver = new GenreResolver;

        $genre = $resolver->resolve('Tech house');

        $this->assertTrue($resolver->resolve('TechHouse')?->is($genre));
        $this->assertSame(1, Genre::query()->count());
    }

    public function test_the_hydrator_uses_one_query_per_kind_on_mariadb(): void
    {
        $media = Media::factory()->count(10)->create();
        $page = Page::factory()->withBlocks([
            ['type' => BlockType::EpkGallery->value, 'data' => ['image_media_ids' => $media->pluck('id')->all()]],
        ])->create();

        DB::enableQueryLog();
        $references = (new BlockHydrator)->hydrate($page);
        $queries = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertSame(1, $queries);
        $this->assertNotNull($references->media($media->last()?->id));
    }

    public function test_foreign_keys_cascade_and_null_on_delete(): void
    {
        $mix = Mix::factory()->create();
        $genre = Genre::factory()->create();
        $mix->genres()->attach($genre);

        $genre->delete();

        $this->assertDatabaseCount('genre_mix', 0);
        $this->assertModelExists($mix);
    }
}
