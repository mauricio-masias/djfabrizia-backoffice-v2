<?php

namespace App\Filament\Resources\Playlists\Schemas;

use App\Filament\Forms\PublishingSection;
use App\Filament\Forms\SyncedNotice;
use Djfabrizia\Content\Models\Playlist;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PlaylistForm
{
    public static function configure(Schema $schema): Schema
    {
        $upstream = fn (?Playlist $record): bool => SyncedNotice::isSynced($record);

        return $schema
            ->components([
                SyncedNotice::make(),
                Grid::make(['lg' => 3])
                    ->columnSpanFull()
                    ->schema([
                        Section::make('Playlist')
                            ->columnSpan(['lg' => 2])
                            ->columns(2)
                            ->schema([
                                TextInput::make('title')->required()->maxLength(255)->columnSpanFull()->disabled($upstream),
                                TextInput::make('short_name')->maxLength(255),
                                TextInput::make('tracks_total')->label('Tracks')->numeric()->minValue(0)->disabled($upstream),
                                TextInput::make('url')->label('Spotify URL')->url()->required()->maxLength(512)->columnSpanFull()->disabled($upstream),
                                TextInput::make('image_url')->label('Cover URL')->url()->maxLength(512)->columnSpanFull()->disabled($upstream),
                                TextInput::make('owner_url')->label('Owner URL')->url()->maxLength(512)->disabled($upstream),
                                Toggle::make('collaborative')->inline(false)->disabled($upstream),
                            ]),
                        PublishingSection::make()->columnSpan(['lg' => 1]),
                    ]),
            ]);
    }
}
