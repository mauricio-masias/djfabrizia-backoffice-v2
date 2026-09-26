<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Djfabrizia\Content\Enums\BookingStatus;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(['lg' => 3])
                    ->columnSpanFull()
                    ->schema([
                        Section::make('Request')
                            ->columnSpan(['lg' => 2])
                            ->columns(2)
                            ->schema([
                                TextInput::make('name')->disabled(),
                                TextInput::make('email')->disabled(),
                                Textarea::make('message')->disabled()->autosize()->columnSpanFull(),
                            ]),
                        Section::make('Status')
                            ->columnSpan(['lg' => 1])
                            ->schema([
                                ToggleButtons::make('status')
                                    ->hiddenLabel()
                                    ->options(BookingStatus::options())
                                    ->colors(collect(BookingStatus::cases())->mapWithKeys(fn (BookingStatus $status): array => [$status->value => $status->color()])->all())
                                    ->inline()
                                    ->required(),
                                TextInput::make('created_at')->label('Received')->disabled(),
                                TextInput::make('ip')->label('IP address')->disabled(),
                            ]),
                    ]),
            ]);
    }
}
