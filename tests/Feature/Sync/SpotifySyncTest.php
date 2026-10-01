<?php

namespace Tests\Feature\Sync;

use App\Settings\SiteSettings;
use App\Sync\Sources\SpotifySource;
use App\Sync\SyncRunner;
use Djfabrizia\Content\Enums\ContentSource;
use Djfabrizia\Content\Enums\SyncProvider;
use Djfabrizia\Content\Enums\SyncStatus;
use Djfabrizia\Content\Models\OauthToken;
use Djfabrizia\Content\Models\Playlist;
use Djfabrizia\Content\Models\SyncRun;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Sleep;
use Tests\TestCase;

class SpotifySyncTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
        Sleep::fake();
        config(['services.spotify.client_id' => 'client', 'services.spotify.client_secret' => 'secret', 'services.spotify.refresh_token' => null]);
        SiteSettings::save(['sync' => ['spotify_user_id' => '11162006882'], 'bookings' => []]);
    }

    /**
     * @return array<string, mixed>
     */
    private function playlist(string $id, string $name = 'Deep Tech House'): array
    {
        return [
            'id' => $id,
            'name' => $name,
            'collaborative' => false,
            'uri' => "spotify:playlist:{$id}",
            'external_urls' => ['spotify' => "https://open.spotify.com/playlist/{$id}"],
            'images' => [['url' => "https://i.scdn.co/{$id}.jpg"]],
            'owner' => ['id' => '11162006882', 'external_urls' => ['spotify' => 'https://open.spotify.com/user/11162006882']],
            'tracks' => ['total' => 26],
        ];
    }

    private function fakeSpotify(array $tokenResponse = ['access_token' => 'app-token', 'expires_in' => 3600], int $tokenStatus = 200): void
    {
        Http::fake([
            'accounts.spotify.com/api/token' => Http::response($tokenResponse, $tokenStatus),
            'api.spotify.com/v1/users/11162006882/playlists*' => Http::response(['items' => [$this->playlist('abc')], 'next' => null]),
        ]);
    }

    private function sync(): SyncRun
    {
        return app(SyncRunner::class)->run(app(SpotifySource::class));
    }

    public function test_public_playlists_are_read_with_an_app_token(): void
    {
        $this->fakeSpotify();

        $run = $this->sync();

        $playlist = Playlist::query()->sole();
        $this->assertSame(SyncStatus::Success, $run->status);
        $this->assertSame(['abc', 26, ContentSource::Spotify, 'Deep Tech House'], [$playlist->external_id, $playlist->tracks_total, $playlist->source, $playlist->short_name]);
        Http::assertSent(fn (Request $request): bool => str_contains($request->url(), 'api/token') && $request['grant_type'] === 'client_credentials');
        Http::assertSent(fn (Request $request): bool => str_contains($request->url(), 'playlists') && $request->hasHeader('Authorization', 'Bearer app-token'));
    }

    public function test_the_token_is_stored_encrypted_and_reused_until_it_expires(): void
    {
        $this->fakeSpotify();

        $this->sync();
        $this->sync();

        Http::assertSentCount(3, 'one token request, two playlist requests');
        $raw = DB::table('oauth_tokens')->value('access_token');
        $this->assertNotSame('app-token', $raw);
        $this->assertSame('app-token', OauthToken::query()->sole()->access_token);
    }

    public function test_a_refresh_token_is_used_and_its_rotation_is_kept(): void
    {
        config(['services.spotify.refresh_token' => 'refresh-1']);
        $this->fakeSpotify(['access_token' => 'user-token', 'refresh_token' => 'refresh-2', 'expires_in' => 3600]);

        $this->sync();

        Http::assertSent(fn (Request $request): bool => str_contains($request->url(), 'api/token') && $request['refresh_token'] === 'refresh-1');
        $this->assertSame('refresh-2', OauthToken::query()->where('provider', SyncProvider::Spotify->value)->sole()->refresh_token);
    }

    public function test_a_rejected_refresh_token_fails_the_run_with_a_clear_message(): void
    {
        config(['services.spotify.refresh_token' => 'expired']);
        OauthToken::query()->create(['provider' => 'spotify', 'access_token' => 'old', 'refresh_token' => 'stale', 'expires_at' => now()->subHour()]);
        $this->fakeSpotify(['error' => 'invalid_grant'], 400);

        $run = $this->sync();

        $this->assertSame(SyncStatus::Failed, $run->status);
        $this->assertStringContainsString('invalid_grant', (string) $run->error);
        $this->assertSame(0, OauthToken::query()->count(), 'the rejected token is forgotten');
    }

    public function test_missing_credentials_fail_the_run(): void
    {
        config(['services.spotify.client_id' => null]);

        $this->assertStringContainsString('SPOTIFY_CLIENT_ID', (string) $this->sync()->error);
    }
}
