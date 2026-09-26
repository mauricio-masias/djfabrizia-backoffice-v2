<?php

namespace App\Filament\Resources\Menus\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MenusTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->withCount('items'))
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('slug')->badge()->color('gray'),
                TextColumn::make('items_count')->label('Items'),
            ])
            ->paginated(false)
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
