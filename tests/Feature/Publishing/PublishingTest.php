<?php

namespace Tests\Feature\Publishing;

use App\Events\ContentChanged;
use App\Filament\Pages\Dashboard;
use App\Filament\Resources\Mixes\Pages\EditMix;
use App\Filament\Resources\Pages\Actions\PreviewJsonAction;
use App\Filament\Resources\PublishEvents\Pages\ListPublishEvents;
use App\Listeners\QueueEndpointWarm;
use App\Publishing\ContentTopics;
use App\Publishing\EndpointWarmer;
use App\Publishing\PendingWarmTopics;
use App\Settings\SiteSettings;
use App\Sync\Sources\MixcloudSource;
use App\Sync\SyncRunner;
use Djfabrizia\Content\Enums\PublishEventStatus;
use Djfabrizia\Content\Models\Menu;
use Djfabrizia\Content\Models\MenuItem;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Page;
use Djfabrizia\Content\Models\PublishEvent;
use Djfabrizia\Content\Models\UkVenue;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Sleep;
use Livewire\Livewire;
use Mockery;
use Tests\Feature\Filament\AdminTestCase;

class PublishingTest extends AdminTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
        Sleep::fake();
        config(['cms.endpoint.url' => 'http://endpoint.test', 'cms.endpoint.warm_token' => 'warm-secret', 'cms.endpoint.preview_token' => 'preview-secret']);
        app(PendingWarmTopics::class)->pull();
    }

    private function fakeEndpoint(int $status = 200): void
    {
        Http::fake(['endpoint.test/api/v1/cache/warm' => Http::response(['status' => 'ok', 'duration_ms' => 12, 'totals' => ['warmed' => 5]], $status)]);
    }

    public function test_content_maps_to_endpoint_topics(): void
    {
        $page = Page::factory()->create(['slug' => 'bio']);
        $page->slug = 'about';
        $menu = Menu::factory()->create(['slug' => 'footer']);

        $this->assertSame(['pages:about', 'pages:bio'], ContentTopics::for($page), 'a renamed page also clears its old slug');
        $this->assertSame(['menus:footer'], ContentTopics::for(MenuItem::factory()->for($menu)->make()));
        $this->assertSame(['venues'], ContentTopics::for(UkVenue::factory()->make()));
    }

    public function test_editing_a_mix_publishes_the_mixes_topic_to_the_endpoint(): void
    {
        $this->fakeEndpoint();
        $mix = Mix::factory()->manual()->create();

        Livewire::test(EditMix::class, ['record' => $mix->getRouteKey()])
            ->fillForm(['title' => 'Renamed'])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertContains('mixes', app(PendingWarmTopics::class)->all());

        $event = app(EndpointWarmer::class)->flush();

        Http::assertSent(fn (Request $request): bool => $request->url() === 'http://endpoint.test/api/v1/cache/warm'
            && $request->hasHeader('X-Warm-Token', 'warm-secret')
            && in_array('mixes', $request['topics'], true));
        $this->assertSame(PublishEventStatus::Warmed, $event?->status);
        $this->assertSame($this->admin->id, $event->user_id);
        $this->assertSame([], app(PendingWarmTopics::class)->all());
    }

    public function test_a_save_in_the_back_office_is_sent_right_after_the_response(): void
    {
        $this->fakeEndpoint();
        $terminating = null;
        $app = Mockery::mock(Application::class);
        $app->shouldReceive('runningInConsole')->andReturnFalse();
        $app->shouldReceive('terminating')->once()->with(Mockery::on(function ($callback) use (&$terminating): bool {
            $terminating = $callback;

            return true;
        }));
        $app->shouldReceive('make')->with(EndpointWarmer::class)->andReturn(app(EndpointWarmer::class));
        $listener = new QueueEndpointWarm(app(PendingWarmTopics::class), $app);

        $listener->handle(new ContentChanged(['mixes']));
        $listener->handle(new ContentChanged(['pages:home']));
        $terminating();

        Http::assertSentCount(1);
        Http::assertSent(fn (Request $request): bool => $request['topics'] === ['mixes', 'pages:home']);
    }

    public function test_a_busy_endpoint_keeps_the_topics_for_the_next_minute(): void
    {
        $this->fakeEndpoint(429);
        app(PendingWarmTopics::class)->add(['mixes']);

        $event = app(EndpointWarmer::class)->flush();

        $this->assertSame(PublishEventStatus::Queued, $event?->status);
        $this->assertSame(['mixes'], app(PendingWarmTopics::class)->all());
    }

    public function test_an_unreachable_endpoint_is_logged_and_retried(): void
    {
        Http::fake(fn () => throw new ConnectionException('Connection refused'));
        app(PendingWarmTopics::class)->add(['videos']);

        $event = app(EndpointWarmer::class)->flush();

        $this->assertSame(PublishEventStatus::Failed, $event?->status);
        $this->assertStringContainsString('unreachable', (string) $event->response['error']);
        $this->assertSame(['videos'], app(PendingWarmTopics::class)->all());
    }

    public function test_nothing_is_sent_when_nothing_changed(): void
    {
        $this->assertNull(app(EndpointWarmer::class)->flush());
        Http::assertNothingSent();
    }

    public function test_changes_made_while_a_flush_is_running_are_kept(): void
    {
        $pending = app(PendingWarmTopics::class);
        $pending->add(['mixes']);
        Http::fake(function () use ($pending) {
            // Another editor saves while the endpoint is being called.
            $pending->add(['videos']);

            return Http::response(['status' => 'ok', 'totals' => ['warmed' => 1]]);
        });

        app(EndpointWarmer::class)->flush();

        $this->assertSame(['videos'], $pending->all());
    }

    public function test_a_sync_run_publishes_one_topic_not_one_per_mix(): void
    {
        SiteSettings::save(['sync' => ['mixcloud_user' => 'djfabrizia'], 'bookings' => []]);
        Http::fake(['api.mixcloud.com/*' => Http::response(['data' => [
            ['key' => '/djfabrizia/a/', 'name' => 'A', 'created_time' => '2026-01-01T00:00:00Z', 'audio_length' => 60, 'tags' => []],
            ['key' => '/djfabrizia/b/', 'name' => 'B', 'created_time' => '2026-01-02T00:00:00Z', 'audio_length' => 60, 'tags' => []],
        ], 'paging' => []])]);

        app(SyncRunner::class)->run(app(MixcloudSource::class));

        $this->assertSame(['mixes'], app(PendingWarmTopics::class)->all());
    }

    public function test_content_whose_publish_date_passed_is_queued(): void
    {
        Mix::factory()->create(['status' => 'published', 'published_at' => now()->subMinutes(20)]);
        Mix::factory()->create(['status' => 'published', 'published_at' => now()->addDay()]);
        app(PendingWarmTopics::class)->pull();

        $this->artisan('endpoint:warm-scheduled')->assertSuccessful();

        $this->assertSame(['mixes'], app(PendingWarmTopics::class)->all());
    }

    public function test_the_every_minute_task_sends_pending_topics(): void
    {
        $this->fakeEndpoint();
        app(PendingWarmTopics::class)->add(['venues']);

        $this->artisan('endpoint:warm')->expectsOutputToContain('Warmed: venues')->assertSuccessful();
    }

    public function test_the_rebuild_button_warms_everything_and_is_logged(): void
    {
        $this->fakeEndpoint();

        Livewire::test(Dashboard::class)->callAction('rebuildApiCache')->assertNotified('API cache rebuilt');

        Http::assertSent(fn (Request $request): bool => in_array('all', $request['topics'], true));
        Livewire::test(ListPublishEvents::class)->assertCanSeeTableRecords(PublishEvent::query()->get());
    }

    public function test_the_page_preview_is_fetched_with_the_preview_token(): void
    {
        Http::fake(['endpoint.test/api/v2/preview/pages/home' => Http::response(['data' => ['slug' => 'home', 'blocks' => []]])]);

        $json = PreviewJsonAction::fetch(Page::factory()->make(['slug' => 'home']));

        $this->assertStringContainsString('"slug": "home"', $json);
        Http::assertSent(fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer preview-secret'));
    }
}
