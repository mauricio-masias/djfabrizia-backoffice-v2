<?php

namespace Tests\Feature\Sync;

use App\Events\ContentChanged;
use App\Settings\SiteSettings;
use App\Sync\Sources\MixcloudSource;
use App\Sync\SyncRunner;
use Djfabrizia\Content\Blocks\BlockType;
use Djfabrizia\Content\Enums\ContentSource;
use Djfabrizia\Content\Enums\PublishStatus;
use Djfabrizia\Content\Enums\SyncStatus;
use Djfabrizia\Content\Models\Genre;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Page;
use Djfabrizia\Content\Models\SyncRun;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Sleep;
use Tests\TestCase;

class MixcloudSyncTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
        Sleep::fake();
        SiteSettings::save(['sync' => ['mixcloud_user' => 'djfabrizia'], 'bookings' => []]);
    }

    /**
     * @param  list<array<string, mixed>>  $shows
     */
    private function fakeFeed(array $shows, ?string $next = null): void
    {
        Http::fake([
            'api.mixcloud.com/djfabrizia/cloudcasts/*' => Http::response(['data' => $shows, 'paging' => array_filter(['next' => $next])]),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function show(string $slug, array $overrides = []): array
    {
        return [
            'key' => "/djfabrizia/{$slug}/",
            'name' => 'Deep and Tech Animal House Radio Show Episode '.$slug,
            'created_time' => '2026-02-04T20:00:00Z',
            'audio_length' => 3610,
            'pictures' => ['320wx320h' => "https://img/{$slug}-320.jpg", 'thumbnail' => "https://img/{$slug}-50.jpg"],
            'tags' => [['name' => 'Tech house'], ['name' => 'House']],
            ...$overrides,
        ];
    }

    private function sync(): SyncRun
    {
        return app(SyncRunner::class)->run(app(MixcloudSource::class));
    }

    public function test_new_shows_become_published_mixes_with_genres(): void
    {
        Event::fake([ContentChanged::class]);
        $this->fakeFeed([$this->show('one')]);

        $run = $this->sync();

        $mix = Mix::query()->with('genres')->sole();
        $this->assertSame([SyncStatus::Success, 1, 0], [$run->status, $run->created, $run->updated]);
        $this->assertSame(['/djfabrizia/one/', '/djfabrizia/one/', ContentSource::Mixcloud, PublishStatus::Published], [$mix->url, $mix->external_id, $mix->source, $mix->status]);
        $this->assertSame(['60:10', '2026-02-04', 'Deep and Tech Animal House Rad'], [$mix->duration, $mix->published_at?->toDateString(), $mix->short_name]);
        $this->assertSame(['House', 'Tech house'], $mix->genres->pluck('name')->sort()->values()->all());
        Event::assertDispatchedTimes(ContentChanged::class, 1);
        Event::assertDispatched(ContentChanged::class, fn (ContentChanged $event): bool => $event->topics === ['mixes']);
    }

    public function test_a_resync_refreshes_upstream_fields_only(): void
    {
        $mix = Mix::factory()->create([
            'external_id' => '/djfabrizia/one/', 'url' => '/djfabrizia/one/', 'title' => 'Old title',
            'short_name' => 'Edited by an editor', 'status' => PublishStatus::Draft, 'sort' => 7, 'source_tags' => ['Tech house', 'House'],
        ]);
        $mix->genres()->attach($editorGenre = Genre::factory()->create(['name' => 'Editor pick']));
        $this->fakeFeed([$this->show('one', ['name' => 'New title'])]);

        $run = $this->sync();

        $mix->refresh();
        $this->assertSame(1, $run->updated);
        $this->assertSame('New title', $mix->title);
        $this->assertSame(['Edited by an editor', PublishStatus::Draft, 7], [$mix->short_name, $mix->status, $mix->sort], 'editor-owned fields are kept, a hidden mix is not re-published');
        $this->assertSame([$editorGenre->id], $mix->genres()->pluck('genres.id')->all(), 'genres only change when the tags change');
    }

    public function test_changed_tags_re_derive_the_genres(): void
    {
        $mix = Mix::factory()->create(['external_id' => '/djfabrizia/one/', 'url' => '/djfabrizia/one/', 'source_tags' => ['House']]);
        $this->fakeFeed([$this->show('one', ['tags' => [['name' => 'Techno']]])]);

        $this->sync();

        $this->assertSame(['Techno'], $mix->genres()->pluck('name')->all());
    }

    public function test_an_unchanged_feed_changes_nothing_and_triggers_no_rebuild(): void
    {
        $this->fakeFeed([$this->show('one')]);
        $this->sync();
        Event::fake([ContentChanged::class]);

        $run = $this->sync();

        $this->assertSame([0, 0, 0], [$run->created, $run->updated, $run->missing]);
        Event::assertNotDispatched(ContentChanged::class);
    }

    public function test_mixes_gone_upstream_are_deleted_but_manual_mixes_are_kept(): void
    {
        $gone = Mix::factory()->published()->create(['external_id' => '/djfabrizia/gone/']);
        $gone->genres()->attach(Genre::factory()->create());
        $manual = Mix::factory()->manual()->published()->create();
        $this->fakeFeed([$this->show('one')]);

        $run = $this->sync();

        $this->assertSame([1, null], [$run->missing, $run->error]);
        $this->assertModelMissing($gone);
        $this->assertDatabaseMissing('genre_mix', ['mix_id' => $gone->id]);
        $this->assertTrue($manual->fresh()?->isPublished(), 'manual mixes are never touched');
    }

    public function test_a_gone_mix_used_on_a_page_is_kept_as_a_flagged_draft(): void
    {
        $used = Mix::factory()->published()->create(['external_id' => '/djfabrizia/used/', 'title' => 'EPK favourite']);
        Page::factory()->create(['slug' => 'epk-en', 'blocks' => [['type' => BlockType::EpkMixes->value, 'data' => ['items' => [['mix_id' => $used->id]]]]]]);
        $this->fakeFeed([$this->show('one')]);

        $run = $this->sync();

        $this->assertModelExists($used);
        $this->assertSame(PublishStatus::Draft, $used->fresh()?->status);
        $this->assertNotNull($used->fresh()?->source_missing_at);
        $this->assertStringContainsString('"EPK favourite" (used on epk-en)', (string) $run->error);
        $this->assertSame(SyncStatus::Success, $run->status);
    }

    public function test_a_flagged_mix_that_comes_back_is_unflagged_but_stays_draft(): void
    {
        $back = Mix::factory()->missingUpstream()->create(['external_id' => '/djfabrizia/one/', 'url' => '/djfabrizia/one/']);
        $this->fakeFeed([$this->show('one')]);

        $this->sync();

        $this->assertNull($back->fresh()?->source_missing_at);
        $this->assertSame(PublishStatus::Draft, $back->fresh()?->status);
    }

    public function test_an_empty_feed_never_deletes_anything(): void
    {
        $kept = Mix::factory()->published()->create(['external_id' => '/djfabrizia/kept/']);
        $this->fakeFeed([]);

        $run = $this->sync();

        $this->assertModelExists($kept);
        $this->assertSame(SyncStatus::Partial, $run->status);
        $this->assertStringContainsString('nothing was removed', (string) $run->error);
    }

    public function test_all_pages_are_read(): void
    {
        Http::fake([
            'api.mixcloud.com/djfabrizia/cloudcasts/?limit=100' => Http::response(['data' => [$this->show('one')], 'paging' => ['next' => 'https://api.mixcloud.com/djfabrizia/cloudcasts/?limit=100&offset=100']]),
            'api.mixcloud.com/djfabrizia/cloudcasts/?limit=100&offset=100' => Http::response(['data' => [$this->show('two')], 'paging' => []]),
        ]);

        $this->assertSame(2, $this->sync()->created);
    }

    public function test_an_api_failure_fails_the_run_and_flags_nothing(): void
    {
        $kept = Mix::factory()->published()->create(['external_id' => '/djfabrizia/kept/']);
        Http::fake(['api.mixcloud.com/*' => Http::response(['error' => 'down'], 500)]);

        $run = $this->sync();

        $this->assertSame(SyncStatus::Failed, $run->status);
        $this->assertStringContainsString('500', (string) $run->error);
        $this->assertNull($kept->fresh()?->source_missing_at);
        $this->assertTrue($kept->fresh()?->isPublished());
    }

    public function test_a_missing_username_fails_with_a_clear_message(): void
    {
        SiteSettings::save(['sync' => ['mixcloud_user' => null], 'bookings' => []]);

        $this->assertStringContainsString('Mixcloud username', (string) $this->sync()->error);
    }

    public function test_a_failed_later_page_saves_what_was_read_and_removes_nothing(): void
    {
        $kept = Mix::factory()->published()->create(['external_id' => '/djfabrizia/old/']);
        Http::fake([
            'api.mixcloud.com/djfabrizia/cloudcasts/?limit=100' => Http::response(['data' => [$this->show('one')], 'paging' => ['next' => 'https://api.mixcloud.com/djfabrizia/cloudcasts/?limit=100&offset=100']]),
            'api.mixcloud.com/djfabrizia/cloudcasts/?limit=100&offset=100' => Http::response(['error' => 'down'], 503),
        ]);

        $run = $this->sync();

        $this->assertSame([SyncStatus::Partial, 1], [$run->status, $run->created]);
        $this->assertStringContainsString('Stopped at page 2', (string) $run->error);
        $this->assertModelExists($kept);
    }
}
