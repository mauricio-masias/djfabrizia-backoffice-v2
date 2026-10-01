<?php

namespace Tests\Feature\Sync;

use App\Filament\Resources\Mixes\Pages\ListMixes;
use App\Filament\Resources\SyncRuns\Pages\ListSyncRuns;
use App\Filament\Widgets\SyncStatus;
use App\Jobs\SyncProviderJob;
use App\Models\User;
use App\Sync\Sources\YoutubeSource;
use Djfabrizia\Content\Enums\SyncProvider;
use Djfabrizia\Content\Models\SyncRun;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;
use Tests\TestCase;

class SyncJobTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_the_job_picks_the_provider_source_and_never_overlaps(): void
    {
        $job = new SyncProviderJob(SyncProvider::Youtube);

        $this->assertInstanceOf(YoutubeSource::class, SyncProviderJob::source(SyncProvider::Youtube));
        $this->assertInstanceOf(WithoutOverlapping::class, $job->middleware()[0]);
        $this->assertSame(1, $job->tries);
    }

    public function test_each_provider_is_scheduled_daily_and_the_queue_is_drained_every_minute(): void
    {
        $events = collect(app(Schedule::class)->events());

        foreach (['sync-mixcloud', 'sync-spotify', 'sync-youtube'] as $name) {
            $this->assertTrue($events->contains(fn ($event): bool => $event->description === $name), $name);
        }

        $drain = $events->first(fn ($event): bool => $event->description === 'queue-drain');
        $this->assertNotNull($drain);
        $this->assertSame('* * * * *', $drain->expression);
        $this->assertStringContainsString('--stop-when-empty', (string) $drain->command);
    }

    public function test_sync_now_queues_the_job_from_the_back_office(): void
    {
        Queue::fake();
        $this->actingAs(User::factory()->admin()->create());

        Livewire::test(ListMixes::class)->callAction('syncNow')->assertNotified('Sync queued');

        Queue::assertPushed(SyncProviderJob::class, fn (SyncProviderJob $job): bool => $job->provider === SyncProvider::Mixcloud);
    }

    public function test_the_sync_log_and_dashboard_widget_show_the_runs(): void
    {
        $this->actingAs(User::factory()->admin()->create());
        $failed = SyncRun::factory()->failed('Upstream API returned 500')->create(['provider' => SyncProvider::Spotify]);

        Livewire::test(ListSyncRuns::class)->assertCanSeeTableRecords([$failed]);
        Livewire::test(SyncStatus::class)->assertSee('Spotify')->assertSee('Failed');
    }
}
