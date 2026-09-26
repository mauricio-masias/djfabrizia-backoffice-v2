<?php

namespace App\Filament\Resources\Countries\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CountryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Country')
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('name')->required()->maxLength(255),
                        Toggle::make('is_default')
                            ->label('Open by default')
                            ->helperText('Shown expanded in the international list.')
                            ->inline(false),
                    ]),
                Section::make('Cities and clubs')
                    ->columnSpanFull()
                    ->schema([
                        Repeater::make('cities')
                            ->hiddenLabel()
                            ->relationship()
                            ->orderColumn('sort')
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                            ->addActionLabel('Add city')
                            ->schema([
                                TextInput::make('name')->label('City')->required()->maxLength(255),
                                Repeater::make('clubs')
                                    ->relationship()
                                    ->orderColumn('sort')
                                    ->simple(TextInput::make('name')->required()->maxLength(255))
                                    ->addActionLabel('Add club')
                                    ->grid(2),
                            ]),
                    ]),
            ]);
    }
}
