<?php

namespace Tests\Feature\Sync;

use App\Settings\SiteSettings;
use App\Sync\Sources\YoutubeSource;
use App\Sync\SyncRunner;
use Djfabrizia\Content\Enums\SyncStatus;
use Djfabrizia\Content\Models\SyncRun;
use Djfabrizia\Content\Models\Video;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Sleep;
use Tests\TestCase;

class YoutubeSyncTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
        Sleep::fake();
        config(['services.youtube.api_key' => 'yt-secret-key']);
        SiteSettings::save(['sync' => ['youtube_channel_id' => 'djfabrizia'], 'bookings' => []]);
    }

    private function fakeYoutube(): void
    {
        Http::fake(function (Request $request) {
            $url = $request->url();

            return match (true) {
                str_contains($url, '/channels') && str_contains($url, 'forHandle') => Http::response(['items' => []]),
                str_contains($url, '/channels') && str_contains($url, 'forUsername') => Http::response(['items' => [['contentDetails' => ['relatedPlaylists' => ['uploads' => 'UU123']]]]]),
                str_contains($url, '/playlistItems') && ! str_contains($url, 'pageToken') => Http::response([
                    'items' => [
                        ['snippet' => ['title' => 'Cyberdog set'], 'contentDetails' => ['videoId' => 'AAAAAAAAAAA', 'videoPublishedAt' => '2026-01-10T10:00:00Z']],
                        ['snippet' => ['title' => 'Private video'], 'contentDetails' => ['videoId' => 'PPPPPPPPPPP']],
                    ],
                    'nextPageToken' => 'page2',
                ]),
                str_contains($url, '/playlistItems') => Http::response([
                    'items' => [['snippet' => ['title' => 'Hakkasan'], 'contentDetails' => ['videoId' => 'BBBBBBBBBBB', 'videoPublishedAt' => '2025-12-01T10:00:00Z']]],
                ]),
                str_contains($url, '/videos') => Http::response(['items' => [
                    ['id' => 'AAAAAAAAAAA', 'snippet' => ['title' => 'Cyberdog set'], 'contentDetails' => ['duration' => 'PT1H7M28S']],
                    ['id' => 'BBBBBBBBBBB', 'snippet' => ['title' => 'Hakkasan'], 'contentDetails' => ['duration' => 'PT38S']],
                ]]),
                default => Http::response([], 404),
            };
        });
    }

    private function sync(): SyncRun
    {
        return app(SyncRunner::class)->run(app(YoutubeSource::class));
    }

    public function test_uploads_are_synced_with_durations_and_private_videos_skipped(): void
    {
        $this->fakeYoutube();

        $run = $this->sync();

        $this->assertSame([SyncStatus::Success, 2], [$run->status, $run->created]);
        $this->assertSame(['1:07:28', '00:38'], [
            Video::query()->where('youtube_id', 'AAAAAAAAAAA')->value('duration'),
            Video::query()->where('youtube_id', 'BBBBBBBBBBB')->value('duration'),
        ]);
        $this->assertFalse(Video::query()->where('youtube_id', 'PPPPPPPPPPP')->exists());
        $this->assertSame('2026-01-10', Video::query()->where('youtube_id', 'AAAAAAAAAAA')->first()?->published_at?->toDateString());
    }

    public function test_a_legacy_username_is_resolved_after_the_handle_lookup(): void
    {
        $this->fakeYoutube();

        $this->sync();

        Http::assertSent(fn (Request $request): bool => str_contains($request->url(), 'forHandle=%40djfabrizia'));
        Http::assertSent(fn (Request $request): bool => str_contains($request->url(), 'forUsername=djfabrizia'));
    }

    public function test_the_api_key_never_reaches_the_sync_log(): void
    {
        Http::fake(fn () => throw new ConnectionException('cURL error 28 for https://www.googleapis.com/youtube/v3/channels?part=contentDetails&key=yt-secret-key'));

        $run = $this->sync();

        $this->assertSame(SyncStatus::Failed, $run->status);
        $this->assertStringNotContainsString('yt-secret-key', (string) $run->error);
        $this->assertStringContainsString('key=***', (string) $run->error);
    }

    public function test_an_unknown_channel_fails_the_run(): void
    {
        Http::fake(['*' => Http::response(['items' => []])]);

        $this->assertStringContainsString("'djfabrizia' was not found", (string) $this->sync()->error);
    }
}
