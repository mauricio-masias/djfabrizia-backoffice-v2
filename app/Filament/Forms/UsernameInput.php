<?php

namespace App\Filament\Forms;

use Closure;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Sets the login a user signs in with, on the profile and user forms.
 *
 * It is stored in the users.email column, which holds either a username or an
 * email address.
 */
final class UsernameInput
{
    public const string MESSAGE = 'Use only letters, numbers and underscores, or a full email address.';

    private const string PATTERN = '/^[a-z0-9_]+$/iD';

    public static function make(): TextInput
    {
        return TextInput::make('email')
            ->label('Username')
            ->required()
            ->maxLength(255)
            ->autocapitalize('none')
            ->dehydrateStateUsing(fn (?string $state): string => Str::lower((string) $state))
            ->rule(fn (): Closure => function (string $attribute, mixed $value, Closure $fail): void {
                if (! self::isValid($value)) {
                    $fail(self::MESSAGE);
                }
            });
    }

    private static function isValid(mixed $value): bool
    {
        if (! is_string($value)) {
            return false;
        }

        return preg_match(self::PATTERN, $value) === 1
            || Validator::make(['value' => $value], ['value' => 'email'])->passes();
    }
}
