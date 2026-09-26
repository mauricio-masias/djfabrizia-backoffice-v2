<?php

namespace App\Filament\Resources\Releases\Schemas;

use App\Filament\Forms\MediaUpload;
use App\Filament\Forms\PublishingSection;
use Djfabrizia\Content\Enums\CoverSource;
use Djfabrizia\Content\Enums\ReleasePlatform;
use Djfabrizia\Content\Models\RecordLabel;
use Djfabrizia\Content\Models\Release;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ReleaseForm
{
    public static function configure(Schema $schema): Schema
    {
        $isLocalCover = fn (Get $get): bool => $get('cover_source') === CoverSource::Local->value;

        return $schema
            ->components([
                Grid::make(['lg' => 3])
                    ->columnSpanFull()
                    ->schema([
                        Grid::make(1)
                            ->columnSpan(['lg' => 2])
                            ->schema([
                                Section::make('Release')
                                    ->columns(3)
                                    ->schema([
                                        TextInput::make('title')->required()->maxLength(255)->columnSpanFull(),
                                        Select::make('record_label_id')
                                            ->label('Record label')
                                            ->relationship('recordLabel', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->createOptionForm([
                                                TextInput::make('name')->required()->maxLength(255),
                                            ])
                                            ->createOptionUsing(fn (array $data): int => RecordLabel::query()
                                                ->firstOrCreate(['slug' => Str::slug($data['name'])], ['name' => $data['name']])->id),
                                        TextInput::make('year')->numeric()->minValue(1980)->maxValue((int) date('Y') + 1),
                                        TextInput::make('bpm')->placeholder('124bpm')->maxLength(16),
                                        Select::make('primary_genre_id')
                                            ->label('Music style')
                                            ->relationship('primaryGenre', 'name')
                                            ->searchable()
                                            ->preload(),
                                        Select::make('genres')
                                            ->label('Other genres')
                                            ->relationship('genres', 'name')
                                            ->multiple()
                                            ->preload()
                                            ->columnSpan(2),
                                        TextInput::make('duration')->placeholder('7:00')->maxLength(16),
                                        Textarea::make('description')->rows(3)->columnSpanFull(),
                                    ]),
                                Section::make('Store links')
                                    ->schema([
                                        Repeater::make('links')
                                            ->hiddenLabel()
                                            ->relationship()
                                            ->orderColumn('sort')
                                            ->columns(3)
                                            ->defaultItems(0)
                                            ->addActionLabel('Add store link')
                                            ->itemLabel(fn (array $state): ?string => ReleasePlatform::tryFrom((string) ($state['platform'] ?? ''))?->label())
                                            ->schema([
                                                Select::make('platform')->options(ReleasePlatform::options())->required(),
                                                TextInput::make('label')->maxLength(255)->placeholder('Buy on Beatport'),
                                                TextInput::make('url')->url()->required()->maxLength(512),
                                            ]),
                                    ]),
                            ]),
                        Grid::make(1)
                            ->columnSpan(['lg' => 1])
                            ->schema([
                                Section::make('Cover & track')
                                    ->schema([
                                        ToggleButtons::make('cover_source')
                                            ->label('Cover')
                                            ->options(CoverSource::options())
                                            ->default(CoverSource::Local->value)
                                            ->inline()
                                            ->live()
                                            ->required(),
                                        MediaUpload::image('cover_media_id')
                                            ->hiddenLabel()
                                            ->imageEditor()
                                            ->visible($isLocalCover),
                                        TextInput::make('cover_external_url')
                                            ->label('Cover URL')
                                            ->url()
                                            ->maxLength(512)
                                            ->hidden($isLocalCover),
                                        MediaUpload::audio('track_media_id')->label('Preview track (mp3)'),
                                    ]),
                                PublishingSection::make(),
                                Section::make('Imported from WordPress')
                                    ->description('The original "Style | Label | Year" text, kept for reference.')
                                    ->collapsed()
                                    ->visible(fn (?Release $record): bool => filled($record?->legacy_description))
                                    ->schema([
                                        TextInput::make('legacy_description')->hiddenLabel()->disabled(),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
