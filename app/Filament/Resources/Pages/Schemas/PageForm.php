<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Filament\Blocks\BlockForms;
use App\Filament\Forms\PublishingSection;
use Djfabrizia\Content\Enums\PageLocale;
use Djfabrizia\Content\Enums\PageTemplate;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(['lg' => 3])
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(1)
                            ->columnSpan(['lg' => 2])
                            ->schema([
                                Section::make('Page')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('title')->required()->maxLength(255),
                                        TextInput::make('slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->alphaDash()
                                            ->unique(ignoreRecord: true)
                                            ->helperText('The site asks for the page by this name.'),
                                        Select::make('template')
                                            ->options(PageTemplate::options())
                                            ->required()
                                            ->live()
                                            ->disabledOn('edit')
                                            ->helperText('Decides which components the page can use.'),
                                        Select::make('locale')
                                            ->label('Language')
                                            ->options(PageLocale::options())
                                            ->default(PageLocale::English->value)
                                            ->required(),
                                    ]),
                                Section::make('Components')
                                    ->description('Add, remove and drag components to change the page. Empty fields are not shown on the site.')
                                    ->schema([
                                        Builder::make('blocks')
                                            ->hiddenLabel()
                                            ->blocks(fn (Get $get): array => BlockForms::forTemplate(PageTemplate::tryFrom((string) $get('template'))))
                                            ->collapsible()
                                            ->cloneable()
                                            ->blockNumbers(false)
                                            ->blockPickerColumns(2)
                                            ->addActionLabel('Add component'),
                                    ]),
                            ]),
                        Grid::make(1)
                            ->columnSpan(['lg' => 1])
                            ->schema([
                                PublishingSection::make(),
                                Section::make('SEO')
                                    ->collapsible()
                                    ->schema([
                                        TextInput::make('seo.title')->label('Title')->maxLength(70),
                                        Textarea::make('seo.description')->label('Description')->maxLength(160)->rows(3),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
