<?php

namespace App\Filament\Resources\UkVenues;

use App\Filament\NavigationGroup;
use App\Filament\Resources\UkVenues\Pages\CreateUkVenue;
use App\Filament\Resources\UkVenues\Pages\EditUkVenue;
use App\Filament\Resources\UkVenues\Pages\ListUkVenues;
use App\Filament\Resources\UkVenues\Schemas\UkVenueForm;
use App\Filament\Resources\UkVenues\Tables\UkVenuesTable;
use BackedEnum;
use Djfabrizia\Content\Models\UkVenue;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class UkVenueResource extends Resource
{
    protected static ?string $model = UkVenue::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;

    protected static string|UnitEnum|null $navigationGroup = NavigationGroup::Venues;

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'UK venue';

    public static function form(Schema $schema): Schema
    {
        return UkVenueForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UkVenuesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUkVenues::route('/'),
            'create' => CreateUkVenue::route('/create'),
            'edit' => EditUkVenue::route('/{record}/edit'),
        ];
    }
}
