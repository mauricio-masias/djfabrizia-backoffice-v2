<?php

namespace App\Filament\Pages;

use App\Filament\Actions\RebuildApiCacheAction;
use App\Filament\NavigationGroup;
use App\Settings\SiteSettings;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

/**
 * @property-read Schema $form
 */
class Settings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string|UnitEnum|null $navigationGroup = NavigationGroup::System;

    protected static ?int $navigationSort = 1;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(SiteSettings::all());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('Sync accounts')
                    ->description('The accounts the daily Mixcloud, Spotify and YouTube syncs read from. Turning a daily sync off does not affect the manual "Sync now" button.')
                    ->schema([
                        self::syncRow('mixcloud_user', 'mixcloud_enabled', 'djfabrizia'),
                        self::syncRow('spotify_user_id', 'spotify_enabled', '11162006882'),
                        self::syncRow('youtube_channel_id', 'youtube_enabled', 'UC…'),
                    ]),
                Section::make('Bookings')
                    ->schema([
                        TextInput::make('bookings.notify_email')
                            ->label(SiteSettings::FIELDS['bookings']['notify_email'])
                            ->email()
                            ->maxLength(255)
                            ->helperText('Leave empty to use the site\'s default address.'),
                    ]),
            ]);
    }

    private static function syncRow(string $accountKey, string $enabledKey, string $placeholder): Grid
    {
        return Grid::make(['default' => 1, 'md' => 2])
            ->schema([
                TextInput::make("sync.{$accountKey}")->label(SiteSettings::FIELDS['sync'][$accountKey])->placeholder($placeholder)->maxLength(100),
                Toggle::make("sync.{$enabledKey}")->label('Daily sync')->default(true)->inline(false),
            ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            Form::make([EmbeddedSchema::make('form')])
                ->id('form')
                ->livewireSubmitHandler('save')
                ->footer([
                    Actions::make([
                        Action::make('save')->label('Save settings')->submit('save'),
                    ]),
                ]),
            Section::make('API cache')
                ->description('Changes you save are published to the website automatically. Rebuild everything only if something looks out of date.')
                ->schema([
                    Actions::make([RebuildApiCacheAction::make()])->key('apiCacheActions'),
                ]),
        ]);
    }

    public function save(): void
    {
        /** @var array<string, array<string, mixed>> $values */
        $values = $this->form->getState();

        SiteSettings::save($values);

        Notification::make()->title('Settings saved')->success()->send();
    }
}
