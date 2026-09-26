<?php

namespace App\Filament\Resources\RecordLabels;

use App\Filament\NavigationGroup;
use App\Filament\Resources\RecordLabels\Pages\CreateRecordLabel;
use App\Filament\Resources\RecordLabels\Pages\EditRecordLabel;
use App\Filament\Resources\RecordLabels\Pages\ListRecordLabels;
use App\Filament\Resources\RecordLabels\Schemas\RecordLabelForm;
use App\Filament\Resources\RecordLabels\Tables\RecordLabelsTable;
use BackedEnum;
use Djfabrizia\Content\Models\RecordLabel;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RecordLabelResource extends Resource
{
    protected static ?string $model = RecordLabel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingLibrary;

    protected static string|UnitEnum|null $navigationGroup = NavigationGroup::Music;

    protected static ?int $navigationSort = 6;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return RecordLabelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RecordLabelsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRecordLabels::route('/'),
            'create' => CreateRecordLabel::route('/create'),
            'edit' => EditRecordLabel::route('/{record}/edit'),
        ];
    }
}
