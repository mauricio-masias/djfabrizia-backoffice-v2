<?php

namespace App\Filament\Resources\SyncRuns\Pages;

use App\Filament\Actions\SyncNowAction;
use App\Filament\Resources\SyncRuns\SyncRunResource;
use Djfabrizia\Content\Enums\SyncProvider;
use Filament\Actions\ActionGroup;
use Filament\Resources\Pages\ListRecords;

class ListSyncRuns extends ListRecords
{
    protected static string $resource = SyncRunResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ActionGroup::make(array_map(
                fn (SyncProvider $provider) => SyncNowAction::make($provider)->name('sync'.$provider->name),
                SyncProvider::cases(),
            ))->label('Sync now')->button(),
        ];
    }
}
