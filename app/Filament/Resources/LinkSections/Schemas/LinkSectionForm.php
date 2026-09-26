<?php

namespace App\Filament\Resources\LinkSections\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LinkSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('label')->required()->maxLength(255)->placeholder('RECENT GIGS'),
                    ]),
            ]);
    }
}
