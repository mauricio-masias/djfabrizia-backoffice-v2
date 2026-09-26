<?php

namespace App\Filament\Resources\Genres\Schemas;

use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class GenreForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state, string $operation) => $operation === 'create'
                                ? $set('slug', Str::slug((string) $state))
                                : null),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->alphaDash()
                            ->unique(ignoreRecord: true)
                            ->helperText('Used in URLs, e.g. ?genre=tech-house.'),
                        TagsInput::make('aliases')
                            ->helperText('Other spellings that should resolve to this genre when syncing or importing.')
                            ->columnSpanFull(),
                        TextInput::make('sort')
                            ->numeric()
                            ->minValue(0)
                            ->helperText('Empty means "unreviewed" (created automatically from a tag).'),
                    ]),
            ]);
    }
}
