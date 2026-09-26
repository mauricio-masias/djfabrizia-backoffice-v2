<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Enums\SyncProvider;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Rotated OAuth tokens (e.g. Spotify), encrypted with the back office APP_KEY.
 * Only the back office reads these.
 *
 * @property int $id
 * @property SyncProvider $provider
 * @property string $access_token
 * @property string|null $refresh_token
 * @property Carbon|null $expires_at
 */
class OauthToken extends Model
{
    use UsesContentConnection;

    protected $fillable = [
        'provider',
        'access_token',
        'refresh_token',
        'expires_at',
    ];

    protected $hidden = [
        'access_token',
        'refresh_token',
    ];

    protected function casts(): array
    {
        return [
            'provider' => SyncProvider::class,
            'access_token' => 'encrypted',
            'refresh_token' => 'encrypted',
            'expires_at' => 'datetime',
        ];
    }

    public function isExpired(int $leewaySeconds = 60): bool
    {
        return $this->expires_at !== null && $this->expires_at->lte(now()->addSeconds($leewaySeconds));
    }
}
