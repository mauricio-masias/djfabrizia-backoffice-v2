<?php

namespace App\Filament\Pages;

use App\Filament\Actions\RebuildApiCacheAction;
use App\Filament\NavigationGroup;
use App\Jobs\SyncProviderJob;
use App\Settings\SiteSettings;
use App\Sync\Sources\SpotifyTokens;
use App\Sync\SyncRunner;
use BackedEnum;
use Djfabrizia\Content\Enums\SyncProvider;
use Djfabrizia\Content\Enums\SyncStatus;
use Djfabrizia\Content\Models\SyncRun;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Size;
use Filament\Support\Enums\TextSize;
use Filament\Support\Icons\Heroicon;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Str;
use Throwable;
use UnitEnum;

/**
 * @property-read Schema $form
 */
class Settings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string|UnitEnum|null $navigationGroup = NavigationGroup::System;

    protected static ?int $navigationSort = 1;

    private const ERROR_EXCERPT_LENGTH = 150;

    private const FAILURE_MESSAGE_LENGTH = 300;

    private const SPOTIFY_EXPIRY_WARNING_DAYS = 21;

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
                        self::syncRow(SyncProvider::Mixcloud, 'mixcloud_user', 'djfabrizia'),
                        self::syncRow(SyncProvider::Spotify, 'spotify_user_id', '11162006882'),
                        self::syncRow(SyncProvider::Youtube, 'youtube_channel_id', 'UC…'),
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

    private static function syncRow(SyncProvider $provider, string $accountKey, string $placeholder): Grid
    {
        return Grid::make(['default' => 1, 'md' => 2, 'xl' => 3])
            ->schema([
                TextInput::make("sync.{$accountKey}")->label(SiteSettings::FIELDS['sync'][$accountKey])->placeholder($placeholder)->maxLength(100),
                Toggle::make("sync.{$provider->value}_enabled")->label('Daily sync')->default(true)->inline(false),
                Group::make([
                    Text::make(fn (): string => self::latestRun($provider)?->status->label() ?? 'Never synced')
                        ->badge()
                        ->color(fn (): string => self::latestRun($provider)?->status->color() ?? 'gray'),
                    Text::make(fn (): string => self::lastSyncText($provider))
                        ->size(TextSize::Small)
                        ->visible(fn (): bool => self::latestRun($provider) !== null),
                    Text::make(fn (): string => Str::limit((string) self::latestRun($provider)?->error, self::ERROR_EXCERPT_LENGTH))
                        ->size(TextSize::Small)
                        ->color('danger')
                        ->visible(fn (): bool => self::latestRun($provider)?->error !== null && self::latestRun($provider)->status !== SyncStatus::Success),
                    ...($provider === SyncProvider::Spotify ? [self::spotifyLoginText()] : []),
                    Actions::make([
                        self::testConnectionAction($provider),
                        ...($provider === SyncProvider::Spotify ? [self::connectSpotifyAction()] : []),
                    ])->key("{$provider->value}Actions"),
                ]),
            ]);
    }

    private static function spotifyLoginText(): Text
    {
        return Text::make(fn (): string => self::spotifyLogin()[0])
            ->size(TextSize::Small)
            ->color(fn (): string => self::spotifyLogin()[1]);
    }

    /**
     * Text and colour for the Spotify login state. The refresh token lives six
     * months from the moment it was authorized.
     *
     * @return array{0: string, 1: string}
     */
    private static function spotifyLogin(): array
    {
        $tokens = app(SpotifyTokens::class);

        if (! $tokens->hasRefreshToken()) {
            return ['Spotify login: not connected', 'danger'];
        }

        $connectedAt = $tokens->connectedAt();

        if ($connectedAt === null) {
            return ['Spotify login: connected (date unknown)', 'gray'];
        }

        $expiresAt = $connectedAt->addMonths(SpotifyTokens::REFRESH_TOKEN_LIFETIME_MONTHS);
        $daysLeft = (int) ceil(now()->diffInDays($expiresAt, false));
        $since = 'Spotify login: connected '.$connectedAt->utc()->format('d/m/y').' (UTC)';

        return match (true) {
            $expiresAt->isPast() => ["{$since} · Login expired — reconnect", 'danger'],
            $daysLeft <= self::SPOTIFY_EXPIRY_WARNING_DAYS => ["{$since} · expires in {$daysLeft} days", 'warning'],
            default => ["{$since} · expires in {$daysLeft} days", 'gray'],
        };
    }

    private static function connectSpotifyAction(): Action
    {
        return Action::make('connectSpotify')
            ->label(fn (): string => app(SpotifyTokens::class)->hasRefreshToken() ? 'Reconnect Spotify' : 'Connect Spotify')
            ->icon(Heroicon::OutlinedLink)
            ->color('gray')
            ->size(Size::Small)
            ->url(fn (): string => route('spotify.connect'));
    }

    private static function latestRun(SyncProvider $provider): ?SyncRun
    {
        return SyncRun::query()->where('provider', $provider->value)->latest('started_at')->latest('id')->first();
    }

    private static function lastSyncText(SyncProvider $provider): string
    {
        $run = self::latestRun($provider);
        $date = $run === null ? null : ($run->finished_at ?? $run->started_at);

        return $date === null ? '' : 'Last sync: '.$date->copy()->utc()->format('d/m/y H:i').' (UTC)';
    }

    private static function testConnectionAction(SyncProvider $provider): Action
    {
        return Action::make("testConnection{$provider->label()}")
            ->label('Test connection')
            ->icon(Heroicon::OutlinedSignal)
            ->color('gray')
            ->size(Size::Small)
            ->tooltip('Checks the saved settings, not unsaved changes')
            ->action(function () use ($provider): void {
                try {
                    $detail = SyncProviderJob::source($provider)->checkConnection();

                    Notification::make()->title("{$provider->label()} connection works")->body($detail)->success()->send();
                } catch (Throwable $exception) {
                    report($exception);

                    Notification::make()
                        ->title("{$provider->label()} connection failed")
                        ->body(SyncRunner::redact(self::failureMessage($exception)))
                        ->danger()
                        ->send();
                }
            });
    }

    /**
     * Laravel cuts HTTP error messages short ("(truncated...)"), which can hide
     * the provider's reason, so for HTTP errors the response itself is used.
     */
    public static function failureMessage(Throwable $exception): string
    {
        if (! $exception instanceof RequestException) {
            return $exception->getMessage();
        }

        $response = $exception->response;
        $reason = $response->json('error.message') ?? $response->json('error_description') ?? $response->json('error');

        if (! is_string($reason) || $reason === '') {
            $reason = trim($response->body());
        }

        return 'HTTP '.$response->status().': '.Str::limit($reason, self::FAILURE_MESSAGE_LENGTH);
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
