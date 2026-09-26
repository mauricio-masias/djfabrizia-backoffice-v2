<?php

namespace App\Filament\Resources\Links\Tables;

use App\Filament\Support\EnumColumn;
use Djfabrizia\Content\Models\Link;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LinksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->with(['image', 'sections']))
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('')
                    ->state(fn (Link $record): ?string => $record->image?->url())
                    ->square()
                    ->imageSize(40),
                TextColumn::make('description')->searchable()->wrap(),
                EnumColumn::make('media')->label('Type'),
                TextColumn::make('sections.label')->badge()->color('gray'),
            ])
            ->reorderable('sort')
            ->defaultSort('sort')
            ->filters([
                SelectFilter::make('sections')->relationship('sections', 'label')->preload(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
