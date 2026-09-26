<?php

namespace App\Filament\Resources\Pages\Tables;

use App\Filament\Resources\Pages\Actions\DuplicatePageAction;
use App\Filament\Support\EnumColumn;
use Djfabrizia\Content\Enums\PageLocale;
use Djfabrizia\Content\Enums\PageTemplate;
use Djfabrizia\Content\Enums\PublishStatus;
use Djfabrizia\Content\Models\Page;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->weight('bold')->description(fn (Page $record): string => '/'.$record->slug),
                TextColumn::make('template')
                    ->badge()
                    ->color('gray')
                    ->formatStateUsing(fn (PageTemplate $state): string => $state->label()),
                TextColumn::make('locale')
                    ->label('Language')
                    ->formatStateUsing(fn (PageLocale $state): string => strtoupper($state->value)),
                EnumColumn::make('status'),
                TextColumn::make('updated_at')->label('Updated')->since()->sortable(),
            ])
            ->defaultSort('slug')
            ->paginated(false)
            ->filters([
                SelectFilter::make('template')->options(PageTemplate::options()),
                SelectFilter::make('locale')->label('Language')->options(PageLocale::options()),
                SelectFilter::make('status')->options(PublishStatus::options()),
            ])
            ->recordActions([
                EditAction::make(),
                DuplicatePageAction::make(),
            ]);
    }
}
