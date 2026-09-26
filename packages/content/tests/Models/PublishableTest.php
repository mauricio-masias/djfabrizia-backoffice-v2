<?php

namespace Djfabrizia\Content\Tests\Models;

use Djfabrizia\Content\Models\Mix;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class PublishableTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_published_scope_excludes_drafts_and_scheduled_items(): void
    {
        $published = Mix::factory()->published()->create();
        $undated = Mix::factory()->create(['status' => 'published', 'published_at' => null]);
        Mix::factory()->draft()->create();
        Mix::factory()->scheduled()->create();

        $ids = Mix::query()->published()->pluck('id')->sort()->values()->all();

        $this->assertSame([$published->id, $undated->id], $ids);
        $this->assertTrue($published->isPublished());
    }

    public function test_a_scheduled_item_is_not_published_yet(): void
    {
        $this->assertFalse(Mix::factory()->scheduled()->create()->isPublished());
    }
}
