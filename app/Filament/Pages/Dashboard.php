<?php

namespace App\Filament\Pages;

use App\Filament\Actions\RebuildApiCacheAction;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected function getHeaderActions(): array
    {
        return [
            RebuildApiCacheAction::make(),
        ];
    }
}
