<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\DemoContentSeeder;
use Database\Seeders\ReferenceSeeder;
use Djfabrizia\Content\Blocks\BlockValidator;
use Djfabrizia\Content\Enums\PageTemplate;
use Djfabrizia\Content\Models\Menu;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Page;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Hash;
use RuntimeException;
use Tests\TestCase;

class SeederTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_reference_seeder_creates_the_menus_and_one_page_per_legacy_page(): void
    {
        $this->seed(ReferenceSeeder::class);

        $this->assertSame(['footer', 'main', 'mobile'], Menu::query()->orderBy('slug')->pluck('slug')->all());
        $this->assertSame(12, Page::query()->count());
        $this->assertSame(6, Page::query()->get()->filter(fn (Page $page): bool => $page->template->isEpk())->count());
        $this->assertSame(952, Page::query()->where('slug', 'home')->value('legacy_wp_id'));
    }

    public function test_reference_seeder_does_not_overwrite_edited_pages(): void
    {
        $this->seed(ReferenceSeeder::class);
        Page::query()->where('slug', 'home')->update(['title' => 'Edited']);

        $this->seed(ReferenceSeeder::class);

        $this->assertSame('Edited', Page::query()->where('slug', 'home')->value('title'));
        $this->assertSame(12, Page::query()->count());
    }

    public function test_seeded_page_blocks_are_valid_for_their_templates(): void
    {
        $this->seed(DatabaseSeeder::class);

        foreach (Page::query()->get() as $page) {
            (new BlockValidator)->validate($page->template, $page->blocks);
        }

        $this->assertSame(PageTemplate::Home, Page::query()->where('slug', 'home')->firstOrFail()->template);
    }

    public function test_admin_seeder_creates_an_admin_from_config(): void
    {
        config(['cms.admin' => ['name' => 'Owner', 'email' => 'owner@example.com', 'password' => 'long-secret']]);

        $this->seed(AdminUserSeeder::class);

        $admin = User::query()->where('email', 'owner@example.com')->firstOrFail();
        $this->assertTrue($admin->is_admin);
        $this->assertTrue(Hash::check('long-secret', $admin->password));
    }

    public function test_admin_seeder_skips_when_credentials_are_missing(): void
    {
        config(['cms.admin' => ['name' => 'Owner', 'email' => null, 'password' => null]]);

        $this->seed(AdminUserSeeder::class);

        $this->assertDatabaseCount('users', 0);
    }

    public function test_demo_content_is_seeded_and_published_in_testing(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertSame(40, Mix::query()->published()->count());
        $this->assertSame(12, Page::query()->published()->count());
    }

    public function test_demo_content_seeder_refuses_to_run_in_production(): void
    {
        $this->app->detectEnvironment(fn (): string => 'production');

        $this->expectException(RuntimeException::class);

        $this->app->make(DemoContentSeeder::class)->run();
    }
}
