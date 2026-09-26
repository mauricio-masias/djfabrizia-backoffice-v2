<?php

namespace App\Filament\Pages;

use App\Filament\NavigationGroup;
use App\Settings\SiteSettings;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
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
                    ->description('The accounts the daily Mixcloud, Spotify and YouTube syncs read from.')
                    ->columns(3)
                    ->schema([
                        TextInput::make('sync.mixcloud_user')->label(SiteSettings::FIELDS['sync']['mixcloud_user'])->placeholder('djfabrizia')->maxLength(100),
                        TextInput::make('sync.spotify_user_id')->label(SiteSettings::FIELDS['sync']['spotify_user_id'])->placeholder('11162006882')->maxLength(100),
                        TextInput::make('sync.youtube_channel_id')->label(SiteSettings::FIELDS['sync']['youtube_channel_id'])->placeholder('UC…')->maxLength(100),
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
