<?php

namespace App\Sync\Sources;

use App\Sync\SyncHttp;
use Djfabrizia\Content\Enums\SyncProvider;
use Djfabrizia\Content\Models\OauthToken;
use Illuminate\Http\Client\RequestException;
use RuntimeException;

/**
 * Spotify access tokens, cached (encrypted) in `oauth_tokens`.
 *
 * With a refresh token (config, or one Spotify rotated earlier) the user's
 * own token is used; otherwise an app token (client credentials) reads
 * public playlists.
 */
class SpotifyTokens
{
    public function accessToken(): string
    {
        $stored = OauthToken::query()->where('provider', SyncProvider::Spotify->value)->first();

        if ($stored !== null && ! $stored->isExpired()) {
            return $stored->access_token;
        }

        $clientId = (string) config('services.spotify.client_id');
        $clientSecret = (string) config('services.spotify.client_secret');

        if ($clientId === '' || $clientSecret === '') {
            throw new RuntimeException('Spotify credentials are missing: set SPOTIFY_CLIENT_ID and SPOTIFY_CLIENT_SECRET in .env.');
        }

        $refreshToken = $stored->refresh_token ?? config('services.spotify.refresh_token');
        $form = is_string($refreshToken) && $refreshToken !== ''
            ? ['grant_type' => 'refresh_token', 'refresh_token' => $refreshToken]
            : ['grant_type' => 'client_credentials'];

        try {
            $response = SyncHttp::client()
                ->withBasicAuth($clientId, $clientSecret)
                ->asForm()
                ->post(config('services.spotify.accounts_url').'/api/token', $form)
                ->throw();
        } catch (RequestException $exception) {
            if ($exception->response->json('error') === 'invalid_grant') {
                // Forget the rejected token, so the next run uses the one in .env.
                $stored?->delete();

                throw new RuntimeException('Spotify rejected the refresh token (invalid_grant). Set a new SPOTIFY_REFRESH_TOKEN in .env; the next run uses it.', previous: $exception);
            }

            throw $exception;
        }

        $token = OauthToken::query()->updateOrCreate(['provider' => SyncProvider::Spotify->value], [
            'access_token' => (string) $response->json('access_token'),
            // Spotify may rotate the refresh token; keep the newest one.
            'refresh_token' => $response->json('refresh_token') ?? ($form['grant_type'] === 'refresh_token' ? $refreshToken : null),
            'expires_at' => now()->addSeconds((int) $response->json('expires_in', 3600)),
        ]);

        return $token->access_token;
    }
}
