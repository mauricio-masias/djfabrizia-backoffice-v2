<?php

namespace App\Filament\Resources\Genres\Tables;

use App\Actions\MergeGenres;
use Djfabrizia\Content\Models\Genre;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GenresTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->withCount(['mixes', 'releases']))
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('slug')->color('gray')->searchable(),
                TextColumn::make('aliases')->badge()->color('gray')->limitList(3)->toggleable(),
                TextColumn::make('mixes_count')->label('Mixes')->sortable(),
                TextColumn::make('releases_count')->label('Releases')->sortable(),
                TextColumn::make('sort')
                    ->placeholder('Unreviewed')
                    ->sortable(),
            ])
            ->defaultSort('name')
            ->filters([
                Filter::make('unreviewed')
                    ->query(fn (Builder $query): Builder => $query->whereNull('sort')),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('merge')
                        ->label('Merge into…')
                        ->icon(Heroicon::OutlinedArrowsPointingIn)
                        ->schema(fn (Collection $records): array => [
                            Select::make('target')
                                ->label('Keep this genre')
                                ->options($records->pluck('name', 'id'))
                                ->required()
                                ->helperText('The others are deleted; their mixes, releases and names move to it.'),
                        ])
                        ->action(function (Collection $records, array $data): void {
                            $target = $records->firstWhere('id', (int) $data['target']);

                            if (! $target instanceof Genre) {
                                return;
                            }

                            app(MergeGenres::class)->handle($target, $records);

                            Notification::make()->title("Merged into {$target->name}")->success()->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
