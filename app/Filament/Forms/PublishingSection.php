<?php

namespace App\Filament\Forms;

use Djfabrizia\Content\Enums\PublishStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;

/**
 * Status + publish date, shared by every publishable resource.
 */
final class PublishingSection
{
    public static function make(): Section
    {
        return Section::make('Publishing')
            ->schema([
                ToggleButtons::make('status')
                    ->options(PublishStatus::options())
                    ->colors([
                        PublishStatus::Draft->value => PublishStatus::Draft->color(),
                        PublishStatus::Published->value => PublishStatus::Published->color(),
                    ])
                    ->default(PublishStatus::Draft->value)
                    ->inline()
                    ->required(),
                DateTimePicker::make('published_at')
                    ->label('Publish date')
                    ->helperText('Leave empty to publish immediately. A future date schedules it (checked every minute).')
                    ->timezone(config('app.editor_timezone'))
                    ->seconds(false),
            ]);
    }
}
