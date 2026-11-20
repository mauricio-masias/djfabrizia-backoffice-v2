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
use Djfabrizia\Content\Models\Setting;
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
        config(['services.spotify.client_id' => 'client', 'services.spotify.client_secret' => 'secret', 'services.spotify.refresh_token' => 'env-refresh']);
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
            'public' => true,
            'items' => ['total' => 26],
        ];
    }

    /**
     * @param  list<array<string, mixed>>|null  $playlists
     */
    private function fakeSpotify(array $tokenResponse = ['access_token' => 'user-token', 'expires_in' => 3600], int $tokenStatus = 200, ?array $playlists = null, string $account = '11162006882'): void
    {
        Http::fake([
            'accounts.spotify.com/api/token' => Http::response($tokenResponse, $tokenStatus),
            'api.spotify.com/v1/me' => Http::response(['id' => $account]),
            'api.spotify.com/v1/me/playlists*' => Http::response(['items' => $playlists ?? [$this->playlist('abc')], 'next' => null]),
        ]);
    }

    private function sync(): SyncRun
    {
        return app(SyncRunner::class)->run(app(SpotifySource::class));
    }

    public function test_owned_public_playlists_are_read_from_me_playlists_with_the_user_token(): void
    {
        $this->fakeSpotify();

        $run = $this->sync();

        $playlist = Playlist::query()->sole();
        $this->assertSame(SyncStatus::Success, $run->status);
        $this->assertSame(['abc', 26, ContentSource::Spotify, 'Deep Tech House'], [$playlist->external_id, $playlist->tracks_total, $playlist->source, $playlist->short_name]);
        Http::assertSent(fn (Request $request): bool => str_contains($request->url(), 'api/token') && $request['grant_type'] === 'refresh_token' && $request['refresh_token'] === 'env-refresh');
        Http::assertSent(fn (Request $request): bool => str_ends_with($request->url(), '/me/playlists?limit=50') && $request->hasHeader('Authorization', 'Bearer user-token'));
        Http::assertNotSent(fn (Request $request): bool => str_contains($request->url(), '/users/'));
    }

    public function test_the_track_count_falls_back_to_the_old_tracks_field(): void
    {
        $legacy = $this->playlist('old');
        unset($legacy['items']);
        $legacy['tracks'] = ['total' => 9];
        $this->fakeSpotify(playlists: [$legacy]);

        $this->sync();

        $this->assertSame(9, Playlist::query()->sole()->tracks_total);
    }

    public function test_only_public_playlists_owned_by_the_configured_user_are_kept(): void
    {
        $followed = $this->playlist('followed');
        $followed['owner']['id'] = 'someone-else';
        $private = [...$this->playlist('private'), 'public' => false];
        $unknownVisibility = [...$this->playlist('unknown'), 'public' => null];
        $this->fakeSpotify(playlists: [$this->playlist('mine'), $followed, $private, $unknownVisibility]);

        $this->sync();

        $this->assertSame(['mine'], Playlist::query()->pluck('external_id')->all());
    }

    public function test_a_different_connected_account_fails_the_run_clearly(): void
    {
        $this->fakeSpotify(account: 'other-user');

        $run = $this->sync();

        $this->assertSame(SyncStatus::Failed, $run->status);
        $this->assertStringContainsString('connected as other-user but Settings say 11162006882', (string) $run->error);
        $this->assertSame(0, Playlist::query()->count());
    }

    public function test_the_token_is_stored_encrypted_and_reused_until_it_expires(): void
    {
        $this->fakeSpotify();

        $this->sync();
        $this->sync();

        Http::assertSentCount(5, 'one token request, then /me and /me/playlists per run');
        $raw = DB::table('oauth_tokens')->value('access_token');
        $this->assertNotSame('user-token', $raw);
        $this->assertSame('user-token', OauthToken::query()->sole()->access_token);
    }

    public function test_a_rotated_refresh_token_is_kept_without_touching_the_connection_date(): void
    {
        Setting::put('spotify', 'connected_at', '2026-01-01T00:00:00+00:00');
        $this->fakeSpotify(['access_token' => 'user-token', 'refresh_token' => 'refresh-2', 'expires_in' => 3600]);

        $this->sync();

        $this->assertSame('refresh-2', OauthToken::query()->where('provider', SyncProvider::Spotify->value)->sole()->refresh_token);
        $this->assertSame('2026-01-01T00:00:00+00:00', Setting::value('spotify', 'connected_at'));
    }

    public function test_the_stored_refresh_token_wins_over_the_env_one(): void
    {
        OauthToken::query()->create(['provider' => 'spotify', 'access_token' => 'old', 'refresh_token' => 'stored-refresh', 'expires_at' => now()->subHour()]);
        $this->fakeSpotify();

        $this->sync();

        Http::assertSent(fn (Request $request): bool => str_contains($request->url(), 'api/token') && $request['refresh_token'] === 'stored-refresh');
    }

    public function test_a_rejected_refresh_token_clears_the_login_and_fails_the_run(): void
    {
        Setting::put('spotify', 'connected_at', now()->toIso8601String());
        OauthToken::query()->create(['provider' => 'spotify', 'access_token' => 'old', 'refresh_token' => 'stale', 'expires_at' => now()->subHour()]);
        $this->fakeSpotify(['error' => 'invalid_grant'], 400);

        $run = $this->sync();

        $this->assertSame(SyncStatus::Failed, $run->status);
        $this->assertStringContainsString('Spotify login expired or was revoked', (string) $run->error);
        $this->assertSame(0, OauthToken::query()->count(), 'the rejected token is forgotten');
        $this->assertNull(Setting::value('spotify', 'connected_at'));
    }

    public function test_without_any_refresh_token_the_run_says_to_connect(): void
    {
        config(['services.spotify.refresh_token' => null]);

        $run = $this->sync();

        $this->assertSame(SyncStatus::Failed, $run->status);
        $this->assertStringContainsString('use "Connect Spotify" on the Settings page', (string) $run->error);
        Http::assertNothingSent();
    }

    public function test_missing_credentials_fail_the_run(): void
    {
        config(['services.spotify.client_id' => null]);

        $this->assertStringContainsString('SPOTIFY_CLIENT_ID', (string) $this->sync()->error);
    }
}
