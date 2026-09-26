<?php

namespace App\Filament\Resources\Mixes;

use App\Filament\NavigationGroup;
use App\Filament\Resources\Mixes\Pages\CreateMix;
use App\Filament\Resources\Mixes\Pages\EditMix;
use App\Filament\Resources\Mixes\Pages\ListMixes;
use App\Filament\Resources\Mixes\Schemas\MixForm;
use App\Filament\Resources\Mixes\Tables\MixesTable;
use BackedEnum;
use Djfabrizia\Content\Models\Mix;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MixResource extends Resource
{
    protected static ?string $model = Mix::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMusicalNote;

    protected static string|UnitEnum|null $navigationGroup = NavigationGroup::Music;

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return MixForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MixesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMixes::route('/'),
            'create' => CreateMix::route('/create'),
            'edit' => EditMix::route('/{record}/edit'),
        ];
    }
}
