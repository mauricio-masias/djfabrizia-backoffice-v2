<?php

namespace App\Filament\Resources\UkVenues\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UkVenueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->helperText('As it should appear in the UK gigs list, e.g. "Hakkasan (Mayfair)".'),
                    ]),
            ]);
    }
}
