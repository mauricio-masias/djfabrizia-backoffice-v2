<?php

namespace App\Filament\Resources\Releases\Tables;

use App\Filament\Tables\PublishingColumns;
use Djfabrizia\Content\Enums\CoverSource;
use Djfabrizia\Content\Models\Release;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ReleasesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->with(['coverMedia', 'recordLabel', 'primaryGenre']))
            ->columns([
                ImageColumn::make('cover')
                    ->label('')
                    ->state(fn (Release $record): ?string => $record->cover_source === CoverSource::Local
                        ? $record->coverMedia?->url()
                        : $record->cover_external_url)
                    ->square()
                    ->imageSize(40),
                TextColumn::make('title')->searchable()->wrap(),
                TextColumn::make('recordLabel.name')->label('Label')->searchable()->toggleable(),
                TextColumn::make('primaryGenre.name')->label('Style')->badge()->toggleable(),
                TextColumn::make('year')->sortable(),
                ...PublishingColumns::columns(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                ...PublishingColumns::filters(),
                SelectFilter::make('record_label_id')->label('Label')->relationship('recordLabel', 'name')->preload(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    ...PublishingColumns::bulkActions(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
