<?php

namespace Tests\Feature\Sync;

use App\Filament\Pages\Settings;
use App\Models\User;
use Djfabrizia\Content\Models\OauthToken;
use Djfabrizia\Content\Models\Setting;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SpotifyConnectTest extends TestCase
{
    use LazilyRefreshDatabase;

    private const STATE = 'state-123';

    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
        config([
            'services.spotify.client_id' => 'client',
            'services.spotify.client_secret' => 'secret',
            'services.spotify.redirect_uri' => 'http://127.0.0.1:6060/admin/spotify/callback',
        ]);
    }

    private function signInAdmin(): void
    {
        $this->actingAs(User::factory()->admin()->create());
    }

    public function test_connect_redirects_to_spotify_with_a_saved_state(): void
    {
        $this->signInAdmin();

        $response = $this->get(route('spotify.connect'));

        $location = (string) $response->headers->get('Location');
        $response->assertRedirectContains('https://accounts.spotify.com/authorize?');
        parse_str((string) parse_url($location, PHP_URL_QUERY), $query);
        $this->assertSame('client', $query['client_id']);
        $this->assertSame('code', $query['response_type']);
        $this->assertSame('http://127.0.0.1:6060/admin/spotify/callback', $query['redirect_uri']);
        $this->assertSame('playlist-read-private playlist-read-collaborative', $query['scope']);
        $this->assertArrayNotHasKey('show_dialog', $query);
        $this->assertSame(40, strlen($query['state']));
        $response->assertSessionHas('spotify_oauth_state', $query['state']);
        $this->assertStringNotContainsString('secret', $location);
    }

    public function test_the_redirect_uri_defaults_to_the_callback_route(): void
    {
        config(['services.spotify.redirect_uri' => null]);
        $this->signInAdmin();

        $location = (string) $this->get(route('spotify.connect'))->headers->get('Location');

        parse_str((string) parse_url($location, PHP_URL_QUERY), $query);
        $this->assertSame(route('spotify.callback'), $query['redirect_uri']);
    }

    public function test_the_callback_exchanges_the_code_and_stores_encrypted_tokens(): void
    {
        $this->signInAdmin();
        Http::fake(['accounts.spotify.com/api/token' => Http::response(['access_token' => 'access-1', 'refresh_token' => 'refresh-1', 'expires_in' => 3600])]);

        $response = $this->withSession(['spotify_oauth_state' => self::STATE])
            ->get(route('spotify.callback', ['code' => 'the-code', 'state' => self::STATE]));

        $response->assertRedirect(Settings::getUrl());
        $response->assertSessionMissing('spotify_oauth_state');
        Http::assertSent(fn (Request $request): bool => $request['grant_type'] === 'authorization_code'
            && $request['code'] === 'the-code'
            && $request['redirect_uri'] === 'http://127.0.0.1:6060/admin/spotify/callback'
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('client:secret')));
        $token = OauthToken::query()->sole();
        $this->assertSame(['access-1', 'refresh-1'], [$token->access_token, $token->refresh_token]);
        $this->assertNotSame('refresh-1', DB::table('oauth_tokens')->value('refresh_token'));
        $this->assertNotNull(Setting::value('spotify', 'connected_at'));
    }

    public function test_the_callback_rejects_a_wrong_or_missing_state(): void
    {
        $this->signInAdmin();
        Http::fake();

        $this->withSession(['spotify_oauth_state' => self::STATE])
            ->get(route('spotify.callback', ['code' => 'c', 'state' => 'forged']))
            ->assertRedirect();
        $this->get(route('spotify.callback', ['code' => 'c']))->assertRedirect();

        Http::assertNothingSent();
        $this->assertSame(0, OauthToken::query()->count());
        $this->assertNull(Setting::value('spotify', 'connected_at'));
    }

    public function test_the_state_is_single_use(): void
    {
        $this->signInAdmin();
        Http::fake(['accounts.spotify.com/api/token' => Http::response(['access_token' => 'a', 'refresh_token' => 'r', 'expires_in' => 3600])]);
        $query = ['code' => 'c', 'state' => self::STATE];

        $this->withSession(['spotify_oauth_state' => self::STATE])->get(route('spotify.callback', $query));
        $this->get(route('spotify.callback', $query));

        Http::assertSentCount(1);
    }

    public function test_a_denied_login_is_handled_without_an_exchange(): void
    {
        $this->signInAdmin();
        Http::fake();

        $this->withSession(['spotify_oauth_state' => self::STATE])
            ->get(route('spotify.callback', ['error' => 'access_denied', 'state' => self::STATE]))
            ->assertRedirect(Settings::getUrl());

        Http::assertNothingSent();
        $this->assertSame(0, OauthToken::query()->count());
    }

    public function test_a_failed_exchange_stores_nothing(): void
    {
        $this->signInAdmin();
        Http::fake(['accounts.spotify.com/api/token' => Http::response(['error' => 'invalid_grant', 'error_description' => 'Invalid authorization code'], 400)]);

        $this->withSession(['spotify_oauth_state' => self::STATE])
            ->get(route('spotify.callback', ['code' => 'bad', 'state' => self::STATE]))
            ->assertRedirect(Settings::getUrl());

        $this->assertSame(0, OauthToken::query()->count());
        $this->assertNull(Setting::value('spotify', 'connected_at'));
    }

    public function test_guests_are_sent_to_the_login(): void
    {
        $this->get(route('spotify.connect'))->assertRedirect(Filament::getLoginUrl());
        $this->get(route('spotify.callback'))->assertRedirect(Filament::getLoginUrl());
    }

    public function test_non_admins_are_forbidden(): void
    {
        $this->actingAs(User::factory()->create(['is_admin' => false]));

        $this->get(route('spotify.connect'))->assertForbidden();
        $this->get(route('spotify.callback'))->assertForbidden();
    }
}
