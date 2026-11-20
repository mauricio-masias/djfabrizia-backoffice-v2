<?php

namespace App\Http\Controllers;

use App\Filament\Pages\Settings;
use App\Sync\Sources\SpotifyTokens;
use App\Sync\SyncRunner;
use Filament\Notifications\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

/**
 * Authorization Code flow for Spotify. The client secret never leaves the
 * server and tokens are neither logged nor shown.
 */
class SpotifyAuthController
{
    private const STATE_KEY = 'spotify_oauth_state';

    private const STATE_LENGTH = 40;

    public function connect(Request $request, SpotifyTokens $tokens): RedirectResponse
    {
        $state = Str::random(self::STATE_LENGTH);
        $request->session()->put(self::STATE_KEY, $state);

        return redirect()->away($tokens->authorizeUrl($state));
    }

    public function callback(Request $request, SpotifyTokens $tokens): RedirectResponse
    {
        $expected = $request->session()->pull(self::STATE_KEY);
        $state = $request->query('state');

        if (! is_string($expected) || ! is_string($state) || ! hash_equals($expected, $state)) {
            return $this->finish('Spotify connection failed', 'The login could not be verified. Please try again.', false);
        }

        $error = $request->query('error');

        if (is_string($error) && $error !== '') {
            return $this->finish('Spotify was not connected', $error === 'access_denied' ? 'Access was denied on Spotify.' : 'Spotify returned an error.', false);
        }

        $code = $request->query('code');

        if (! is_string($code) || $code === '') {
            return $this->finish('Spotify connection failed', 'Spotify did not send an authorization code.', false);
        }

        try {
            $tokens->exchangeCode($code);
        } catch (Throwable $exception) {
            report($exception);

            return $this->finish('Spotify connection failed', Settings::failureMessage($exception), false);
        }

        return $this->finish('Spotify connected', 'The playlist sync can now read your playlists.', true);
    }

    private function finish(string $title, string $body, bool $success): RedirectResponse
    {
        $notification = Notification::make()->title($title)->body(SyncRunner::redact($body));
        ($success ? $notification->success() : $notification->danger())->send();

        return redirect()->to(Settings::getUrl());
    }
}
