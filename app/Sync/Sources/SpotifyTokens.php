<?php

namespace App\Sync\Sources;

use App\Sync\SyncHttp;
use Carbon\CarbonImmutable;
use Djfabrizia\Content\Enums\SyncProvider;
use Djfabrizia\Content\Models\OauthToken;
use Djfabrizia\Content\Models\Setting;
use Illuminate\Http\Client\RequestException;
use RuntimeException;

/**
 * Spotify tokens, kept (encrypted) in `oauth_tokens`.
 *
 * Spotify's Development Mode only serves user data to a logged-in user, so the
 * back office connects once through the Authorization Code flow ("Connect
 * Spotify" on the Settings page). The stored refresh token wins over the
 * SPOTIFY_REFRESH_TOKEN bootstrap value in .env. Refresh tokens of dashboard
 * apps last six months from authorization, and refreshing does not extend that.
 */
class SpotifyTokens
{
    public const SCOPES = 'playlist-read-private playlist-read-collaborative';

    public const REFRESH_TOKEN_LIFETIME_MONTHS = 6;

    public function redirectUri(): string
    {
        return (string) (config('services.spotify.redirect_uri') ?: route('spotify.callback'));
    }

    public function authorizeUrl(string $state): string
    {
        return config('services.spotify.accounts_url').'/authorize?'.http_build_query([
            'client_id' => (string) config('services.spotify.client_id'),
            'response_type' => 'code',
            'redirect_uri' => $this->redirectUri(),
            'scope' => self::SCOPES,
            'state' => $state,
        ]);
    }

    /**
     * Trades the authorization code for tokens and remembers when the user
     * connected (the six months run from here).
     */
    public function exchangeCode(string $code): void
    {
        [$clientId, $clientSecret] = $this->credentials();

        $response = SyncHttp::client()
            ->withBasicAuth($clientId, $clientSecret)
            ->asForm()
            ->post(config('services.spotify.accounts_url').'/api/token', [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => $this->redirectUri(),
            ])
            ->throw();

        if (! is_string($response->json('refresh_token')) || $response->json('refresh_token') === '') {
            throw new RuntimeException('Spotify did not return a refresh token. Try connecting again.');
        }

        OauthToken::query()->updateOrCreate(['provider' => SyncProvider::Spotify->value], [
            'access_token' => (string) $response->json('access_token'),
            'refresh_token' => (string) $response->json('refresh_token'),
            'expires_at' => now()->addSeconds((int) $response->json('expires_in', 3600)),
        ]);
        Setting::put('spotify', 'connected_at', now()->toIso8601String());
    }

    public function connectedAt(): ?CarbonImmutable
    {
        $value = Setting::value('spotify', 'connected_at');

        return is_string($value) && $value !== '' ? CarbonImmutable::parse($value) : null;
    }

    public function hasStoredToken(): bool
    {
        return OauthToken::query()->where('provider', SyncProvider::Spotify->value)->whereNotNull('refresh_token')->exists();
    }

    public function hasRefreshToken(): bool
    {
        return $this->hasStoredToken() || (string) config('services.spotify.refresh_token') !== '';
    }

    public function accessToken(): string
    {
        $stored = OauthToken::query()->where('provider', SyncProvider::Spotify->value)->first();

        if ($stored !== null && ! $stored->isExpired()) {
            return $stored->access_token;
        }

        [$clientId, $clientSecret] = $this->credentials();

        $refreshToken = $stored->refresh_token ?? config('services.spotify.refresh_token');

        if (! is_string($refreshToken) || $refreshToken === '') {
            throw new RuntimeException('Spotify is not connected: use "Connect Spotify" on the Settings page.');
        }

        try {
            $response = SyncHttp::client()
                ->withBasicAuth($clientId, $clientSecret)
                ->asForm()
                ->post(config('services.spotify.accounts_url').'/api/token', ['grant_type' => 'refresh_token', 'refresh_token' => $refreshToken])
                ->throw();
        } catch (RequestException $exception) {
            if ($exception->response->json('error') === 'invalid_grant') {
                $stored?->delete();
                Setting::put('spotify', 'connected_at', null);

                throw new RuntimeException('Spotify login expired or was revoked (refresh tokens last 6 months). Use "Connect Spotify" on the Settings page.', previous: $exception);
            }

            throw $exception;
        }

        // connected_at is left alone: the six months run from authorization, not from a refresh.
        $token = OauthToken::query()->updateOrCreate(['provider' => SyncProvider::Spotify->value], [
            'access_token' => (string) $response->json('access_token'),
            // Spotify may rotate the refresh token; keep the newest one.
            'refresh_token' => $response->json('refresh_token') ?? $refreshToken,
            'expires_at' => now()->addSeconds((int) $response->json('expires_in', 3600)),
        ]);

        return $token->access_token;
    }

    /**
     * @return array{0: string, 1: string}
     */
    private function credentials(): array
    {
        $clientId = (string) config('services.spotify.client_id');
        $clientSecret = (string) config('services.spotify.client_secret');

        if ($clientId === '' || $clientSecret === '') {
            throw new RuntimeException('Spotify credentials are missing: set SPOTIFY_CLIENT_ID and SPOTIFY_CLIENT_SECRET in .env.');
        }

        return [$clientId, $clientSecret];
    }
}
