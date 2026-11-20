<?php

namespace Tests\Feature\Sync;

use App\Settings\SiteSettings;
use App\Sync\Sources\MixcloudSource;
use App\Sync\Sources\SpotifySource;
use App\Sync\Sources\YoutubeSource;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Sleep;
use RuntimeException;
use Tests\TestCase;

class ConnectionCheckTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
        Sleep::fake();
        config([
            'services.youtube.api_key' => 'yt-secret-key',
            'services.spotify.client_id' => 'client',
            'services.spotify.client_secret' => 'secret',
            'services.spotify.refresh_token' => 'env-refresh',
        ]);
    }

    /**
     * @param  array<string, string>  $sync
     */
    private function settings(array $sync): void
    {
        SiteSettings::save(['sync' => $sync, 'bookings' => []]);
    }

    public function test_mixcloud_reports_the_connected_user(): void
    {
        $this->settings(['mixcloud_user' => 'djfabrizia']);
        Http::fake(['api.mixcloud.com/djfabrizia/' => Http::response(['username' => 'djfabrizia'])]);

        $this->assertSame('Connected to Mixcloud user djfabrizia.', app(MixcloudSource::class)->checkConnection());
    }

    public function test_mixcloud_fails_for_an_unknown_user(): void
    {
        $this->settings(['mixcloud_user' => 'nobody']);
        Http::fake(['api.mixcloud.com/*' => Http::response(['error' => 'not found'], 404)]);

        try {
            app(MixcloudSource::class)->checkConnection();
            $this->fail('Expected a RequestException.');
        } catch (RequestException $exception) {
            $this->assertSame(404, $exception->response->status());
        }

    }

    public function test_mixcloud_needs_a_username(): void
    {
        $this->settings(['mixcloud_user' => '']);
        $this->expectExceptionObject(new RuntimeException('Set the Mixcloud username on the Settings page.'));
        app(MixcloudSource::class)->checkConnection();
    }

    public function test_spotify_reports_the_playlist_total(): void
    {
        $this->settings(['spotify_user_id' => '11162006882']);
        Http::fake([
            'accounts.spotify.com/api/token' => Http::response(['access_token' => 'user-token', 'expires_in' => 3600]),
            'api.spotify.com/v1/me' => Http::response(['id' => '11162006882']),
            'api.spotify.com/v1/me/playlists*' => Http::response(['items' => [], 'total' => 7]),
        ]);

        $this->assertSame('Connected to Spotify as 11162006882: 7 playlists.', app(SpotifySource::class)->checkConnection());
    }

    public function test_spotify_fails_on_invalid_grant(): void
    {
        $this->settings(['spotify_user_id' => '11162006882']);
        config(['services.spotify.refresh_token' => 'old']);
        Http::fake(['accounts.spotify.com/api/token' => Http::response(['error' => 'invalid_grant'], 400)]);

        try {
            app(SpotifySource::class)->checkConnection();
            $this->fail('Expected invalid_grant.');
        } catch (RuntimeException $exception) {
            $this->assertStringContainsString('Connect Spotify', $exception->getMessage());
        }

    }

    public function test_spotify_fails_when_unauthorized(): void
    {
        $this->settings(['spotify_user_id' => '11162006882']);
        Http::fake([
            'accounts.spotify.com/api/token' => Http::response(['access_token' => 'user-token', 'expires_in' => 3600]),
            'api.spotify.com/*' => Http::response([], 401),
        ]);

        try {
            app(SpotifySource::class)->checkConnection();
            $this->fail('Expected a RequestException.');
        } catch (RequestException $exception) {
            $this->assertSame(401, $exception->response->status());
        }

    }

    public function test_spotify_fails_when_connected_as_another_account(): void
    {
        $this->settings(['spotify_user_id' => '11162006882']);
        Http::fake([
            'accounts.spotify.com/api/token' => Http::response(['access_token' => 'user-token', 'expires_in' => 3600]),
            'api.spotify.com/v1/me' => Http::response(['id' => 'other']),
        ]);

        $this->expectExceptionMessage('Spotify is connected as other but Settings say 11162006882');
        app(SpotifySource::class)->checkConnection();
    }

    public function test_spotify_needs_a_user_id(): void
    {
        $this->settings(['spotify_user_id' => '']);
        $this->expectExceptionObject(new RuntimeException('Set the Spotify user ID on the Settings page.'));
        app(SpotifySource::class)->checkConnection();
    }

    public function test_youtube_reports_the_found_channel(): void
    {
        $this->settings(['youtube_channel_id' => 'UC123']);
        Http::fake(['www.googleapis.com/youtube/v3/channels*' => Http::response(['items' => [['contentDetails' => ['relatedPlaylists' => ['uploads' => 'UU123']]]]])]);

        $this->assertSame('Connected to YouTube: channel UC123 found.', app(YoutubeSource::class)->checkConnection());
        Http::assertSentCount(1);
    }

    public function test_youtube_fails_for_an_unknown_channel(): void
    {
        $this->settings(['youtube_channel_id' => 'UC404']);
        Http::fake(['www.googleapis.com/*' => Http::response(['items' => []])]);

        try {
            app(YoutubeSource::class)->checkConnection();
            $this->fail('Expected channel not found.');
        } catch (RuntimeException $exception) {
            $this->assertSame("YouTube channel 'UC404' was not found.", $exception->getMessage());
        }

    }

    public function test_youtube_fails_when_the_key_is_rejected(): void
    {
        $this->settings(['youtube_channel_id' => 'UC123']);
        Http::fake(['www.googleapis.com/*' => Http::response([], 403)]);

        try {
            app(YoutubeSource::class)->checkConnection();
            $this->fail('Expected a RequestException.');
        } catch (RequestException $exception) {
            $this->assertSame(403, $exception->response->status());
        }

    }

    public function test_youtube_needs_an_api_key(): void
    {
        $this->settings(['youtube_channel_id' => 'UC123']);
        config(['services.youtube.api_key' => '']);
        $this->expectExceptionObject(new RuntimeException('The YouTube API key is missing: set YOUTUBE_API_KEY in .env.'));
        app(YoutubeSource::class)->checkConnection();
    }
}
