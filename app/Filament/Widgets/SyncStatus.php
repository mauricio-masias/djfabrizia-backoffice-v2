<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\SyncRuns\SyncRunResource;
use Djfabrizia\Content\Enums\SyncProvider;
use Djfabrizia\Content\Enums\SyncStatus as RunStatus;
use Djfabrizia\Content\Models\SyncRun;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

/**
 * Last run of each provider sync; failures stand out.
 */
class SyncStatus extends StatsOverviewWidget
{
    protected static ?int $sort = 3;

    protected ?string $heading = 'Syncs';

    protected function getStats(): array
    {
        return array_map(function (SyncProvider $provider): Stat {
            $run = SyncRun::query()->where('provider', $provider->value)->latest('started_at')->first();

            return Stat::make($provider->label(), $run === null ? 'Never run' : $run->status->label())
                ->description($run === null ? 'Runs daily at 3am' : $run->started_at->diffForHumans().' · '.$run->created.' new, '.$run->updated.' updated')
                ->color($run?->status === RunStatus::Failed ? 'danger' : ($run?->status === RunStatus::Partial ? 'warning' : 'gray'))
                ->url(SyncRunResource::getUrl('index'));
        }, SyncProvider::cases());
    }
}
