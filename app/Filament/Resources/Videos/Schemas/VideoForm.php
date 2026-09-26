<?php

namespace App\Filament\Resources\Videos\Schemas;

use App\Filament\Forms\PublishingSection;
use App\Filament\Forms\SyncedNotice;
use Djfabrizia\Content\Models\Video;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VideoForm
{
    public static function configure(Schema $schema): Schema
    {
        $upstream = fn (?Video $record): bool => SyncedNotice::isSynced($record);

        return $schema
            ->components([
                SyncedNotice::make(),
                Grid::make(['lg' => 3])
                    ->columnSpanFull()
                    ->schema([
                        Section::make('Video')
                            ->columnSpan(['lg' => 2])
                            ->columns(2)
                            ->schema([
                                TextInput::make('title')->required()->maxLength(255)->columnSpanFull()->disabled($upstream),
                                TextInput::make('youtube_id')
                                    ->label('YouTube ID')
                                    ->placeholder('L_2sQhuj8bI')
                                    ->required()
                                    ->regex('/^[A-Za-z0-9_-]{11}$/')
                                    ->unique(ignoreRecord: true)
                                    ->disabled($upstream),
                                TextInput::make('duration')->placeholder('2:04:13')->maxLength(16)->disabled($upstream),
                            ]),
                        PublishingSection::make()->columnSpan(['lg' => 1]),
                    ]),
            ]);
    }
}
