<?php

namespace App\Filament\Concerns;

use App\Sync\SyncProgress;
use Filament\Tables\Table;

/**
 * For list pages: tracks sync progress and polls the table every few seconds
 * only while a sync is in progress, so new rows appear when it finishes and
 * polling stops by itself afterwards.
 */
trait PollsSyncProgress
{
    use TracksSyncProgress;

    private const SYNC_POLL_INTERVAL = '5s';

    public function table(Table $table): Table
    {
        return $table->poll(fn (): ?string => SyncProgress::currentlySyncing() === [] ? null : self::SYNC_POLL_INTERVAL);
    }
}
