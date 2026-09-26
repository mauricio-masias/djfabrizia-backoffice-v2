<?php

namespace App\Filament\Resources\Menus\Schemas;

use Djfabrizia\Content\Enums\MenuTarget;
use Djfabrizia\Content\Models\Menu;
use Djfabrizia\Content\Models\MenuItem;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Menu')
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('name')->required()->maxLength(255),
                        TextInput::make('slug')->disabled()->helperText('Fixed: the site asks for this menu by name.'),
                    ]),
                Section::make('Items')
                    ->description('Use a path such as /mixes or /#contact for pages on this site, or a full URL. An icon replaces the text with a social icon.')
                    ->columnSpanFull()
                    ->schema([
                        Repeater::make('items')
                            ->hiddenLabel()
                            ->relationship()
                            ->orderColumn('sort')
                            ->collapsible()
                            ->collapsed()
                            ->columns(4)
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                            ->addActionLabel('Add item')
                            ->schema([
                                TextInput::make('title')->required()->maxLength(255),
                                TextInput::make('url')->label('Link')->required()->maxLength(512),
                                Select::make('target')->options(MenuTarget::options())->default(MenuTarget::Self->value)->required(),
                                TextInput::make('icon')->placeholder('instagram')->maxLength(64),
                                Select::make('parent_id')
                                    ->label('Inside item')
                                    ->placeholder('Top level')
                                    ->options(function (EditRecord $livewire): array {
                                        $menu = $livewire->getRecord();

                                        return $menu instanceof Menu ? MenuItem::query()
                                            ->whereBelongsTo($menu)
                                            ->whereNull('parent_id')
                                            ->pluck('title', 'id')
                                            ->all() : [];
                                    })
                                    ->columnSpan(2),
                            ]),
                    ]),
            ]);
    }
}
