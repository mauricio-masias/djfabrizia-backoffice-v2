<?php

namespace App\Filament\Resources\Links\Schemas;

use App\Filament\Forms\MediaUpload;
use Djfabrizia\Content\Enums\LinkMedia;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class LinkForm
{
    public static function configure(Schema $schema): Schema
    {
        $media = fn (Get $get): ?LinkMedia => LinkMedia::tryFrom((string) $get('media'));

        return $schema
            ->components([
                Grid::make(['lg' => 3])
                    ->columnSpanFull()
                    ->schema([
                        Section::make('Link')
                            ->columnSpan(['lg' => 2])
                            ->columns(2)
                            ->schema([
                                Select::make('media')
                                    ->label('Type')
                                    ->options(LinkMedia::options())
                                    ->default(LinkMedia::Custom->value)
                                    ->required()
                                    ->live()
                                    ->helperText('A platform uses its social link; "… custom" swaps in another account; "Custom" is any URL.'),
                                TextInput::make('url')
                                    ->label(fn (Get $get): string => $media($get)?->isCustomHandle() ? 'Account name' : 'URL')
                                    ->required(fn (Get $get): bool => $media($get) === LinkMedia::Custom || (bool) $media($get)?->isCustomHandle())
                                    ->url(fn (Get $get): bool => $media($get) === LinkMedia::Custom)
                                    ->maxLength(512)
                                    ->visible(fn (Get $get): bool => $media($get) === LinkMedia::Custom || (bool) $media($get)?->isCustomHandle()),
                                TextInput::make('description')->maxLength(255)->columnSpanFull()->placeholder('21.04 | Cyberdog @ Camden Stables'),
                                CheckboxList::make('sections')
                                    ->relationship('sections', 'label')
                                    ->required()
                                    ->columns(2)
                                    ->columnSpanFull(),
                            ]),
                        Section::make('Image')
                            ->columnSpan(['lg' => 1])
                            ->description('Optional for platform links: their logo is used when empty.')
                            ->schema([
                                MediaUpload::image('image_media_id')->hiddenLabel()->imageEditor(),
                            ]),
                    ]),
            ]);
    }
}
