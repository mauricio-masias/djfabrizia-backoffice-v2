<?php

namespace App\Filament\Resources\LinkSections;

use App\Filament\NavigationGroup;
use App\Filament\Resources\LinkSections\Pages\CreateLinkSection;
use App\Filament\Resources\LinkSections\Pages\EditLinkSection;
use App\Filament\Resources\LinkSections\Pages\ListLinkSections;
use App\Filament\Resources\LinkSections\Schemas\LinkSectionForm;
use App\Filament\Resources\LinkSections\Tables\LinkSectionsTable;
use BackedEnum;
use Djfabrizia\Content\Models\LinkSection;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LinkSectionResource extends Resource
{
    protected static ?string $model = LinkSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleGroup;

    protected static string|UnitEnum|null $navigationGroup = NavigationGroup::Links;

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'label';

    protected static ?string $modelLabel = 'linktree section';

    public static function form(Schema $schema): Schema
    {
        return LinkSectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LinkSectionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLinkSections::route('/'),
            'create' => CreateLinkSection::route('/create'),
            'edit' => EditLinkSection::route('/{record}/edit'),
        ];
    }
}
