<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Database\Factories\SyncRunFactory;
use Djfabrizia\Content\Enums\SyncProvider;
use Djfabrizia\Content\Enums\SyncStatus;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property SyncProvider $provider
 * @property SyncStatus $status
 * @property Carbon $started_at
 * @property Carbon|null $finished_at
 * @property int $created
 * @property int $updated
 * @property int $missing
 * @property string|null $error
 */
class SyncRun extends Model
{
    /** @use HasFactory<SyncRunFactory> */
    use HasFactory, UsesContentConnection;

    protected $fillable = [
        'provider',
        'status',
        'started_at',
        'finished_at',
        'created',
        'updated',
        'missing',
        'error',
    ];

    protected $attributes = [
        'status' => 'running',
        'created' => 0,
        'updated' => 0,
        'missing' => 0,
    ];

    protected function casts(): array
    {
        return [
            'provider' => SyncProvider::class,
            'status' => SyncStatus::class,
            'started_at' => 'datetime',
            'finished_at' => 'datetime',
            'created' => 'integer',
            'updated' => 'integer',
            'missing' => 'integer',
        ];
    }

    protected static function newFactory(): SyncRunFactory
    {
        return SyncRunFactory::new();
    }
}
