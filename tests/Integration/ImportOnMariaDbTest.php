<?php

namespace Tests\Integration;

use App\Import\Wordpress\WordpressImporter;
use Database\Seeders\ReferenceSeeder;
use Djfabrizia\Content\Models\Genre;
use Djfabrizia\Content\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Group;
use Tests\Support\WordpressFixture;

#[Group('integration')]
class ImportOnMariaDbTest extends IntegrationTestCase
{
    use RefreshDatabase;

    public function test_the_import_is_idempotent_on_mariadb(): void
    {
        Storage::fake('public');
        Queue::fake();
        config(['cms.import.uploads_path' => sys_get_temp_dir().'/no-uploads']);
        $this->seed(ReferenceSeeder::class);
        WordpressFixture::create()->sampleSite();

        app(WordpressImporter::class)->run();
        $second = app(WordpressImporter::class)->run()->stats();

        $this->assertSame(0, array_sum(array_column($second, 'created')) + array_sum(array_column($second, 'updated')));
        $this->assertSame(1, Genre::query()->where('slug', 'tech-house')->count());
        $this->assertSame(12, Page::query()->whereNotNull('legacy_wp_id')->count());
    }
}
