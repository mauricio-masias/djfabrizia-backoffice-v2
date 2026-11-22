<?php

namespace App\Filament\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;

/**
 * Signs in with whatever the users.email column holds, which may be a username
 * or an email address, so the format is not checked here.
 */
class Login extends BaseLogin
{
    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Username')
            ->required()
            ->maxLength(255)
            ->autocapitalize('none')
            ->autocomplete('username')
            ->autofocus();
    }
}
