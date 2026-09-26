<?php

namespace App\Filament\Resources\SocialLinks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SocialLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('network')
                            ->required()
                            ->maxLength(64)
                            ->helperText('Also used by linktree links of the same platform (e.g. "Instagram").'),
                        TextInput::make('icon_class')->label('Icon')->placeholder('fa-instagram')->maxLength(64),
                        TextInput::make('url')->label('Web URL')->url()->required()->maxLength(512),
                        TextInput::make('app_url')
                            ->label('App link')
                            ->placeholder('instagram://user?username=djfabrizia')
                            ->maxLength(512)
                            ->helperText('Opens the app on phones, when set.'),
                        TextInput::make('type')->maxLength(64),
                    ]),
            ]);
    }
}
