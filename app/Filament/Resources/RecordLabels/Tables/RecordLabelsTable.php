<?php

namespace App\Filament\Resources\RecordLabels\Tables;

use App\Actions\MergeRecordLabels;
use Djfabrizia\Content\Models\RecordLabel;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class RecordLabelsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query): Builder => $query->withCount('releases'))
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('releases_count')->label('Releases')->sortable(),
                TextColumn::make('url')->label('Website')->url(fn (RecordLabel $record): ?string => $record->url)->openUrlInNewTab()->toggleable(),
            ])
            ->defaultSort('name')
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
                                ->label('Keep this label')
                                ->options($records->pluck('name', 'id'))
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data): void {
                            $target = $records->firstWhere('id', (int) $data['target']);

                            if (! $target instanceof RecordLabel) {
                                return;
                            }

                            app(MergeRecordLabels::class)->handle($target, $records);

                            Notification::make()->title("Merged into {$target->name}")->success()->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
