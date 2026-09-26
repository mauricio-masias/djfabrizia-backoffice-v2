<?php

namespace App\Filament\Resources\Mixes\Schemas;

use App\Filament\Forms\PublishingSection;
use App\Filament\Forms\SyncedNotice;
use Djfabrizia\Content\Models\Mix;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MixForm
{
    public static function configure(Schema $schema): Schema
    {
        $upstream = fn (?Mix $record): bool => SyncedNotice::isSynced($record);

        return $schema
            ->components([
                SyncedNotice::make(),
                Grid::make(['lg' => 3])
                    ->columnSpanFull()
                    ->schema([
                        Section::make('Mix')
                            ->columnSpan(['lg' => 2])
                            ->columns(2)
                            ->schema([
                                TextInput::make('title')->required()->maxLength(255)->columnSpanFull()->disabled($upstream),
                                TextInput::make('short_name')
                                    ->maxLength(64)
                                    ->helperText('Shown on cards where the full title is too long.'),
                                TextInput::make('duration')->placeholder('64:56')->maxLength(16)->disabled($upstream),
                                TextInput::make('url')
                                    ->label('Mixcloud path')
                                    ->placeholder('/djfabrizia/show-name/')
                                    ->required()
                                    ->maxLength(512)
                                    ->columnSpanFull()
                                    ->disabled($upstream),
                                TextInput::make('image_url')->label('Cover URL')->url()->maxLength(512)->disabled($upstream),
                                TextInput::make('image_small_url')->label('Small cover URL')->url()->maxLength(512)->disabled($upstream),
                                DateTimePicker::make('released_at')->label('Released')->seconds(false)->disabled($upstream),
                                TagsInput::make('source_tags')->label('Source tags')->disabled()->visible($upstream),
                                Select::make('genres')
                                    ->relationship('genres', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable()
                                    ->columnSpanFull(),
                            ]),
                        PublishingSection::make()->columnSpan(['lg' => 1]),
                    ]),
            ]);
    }
}
