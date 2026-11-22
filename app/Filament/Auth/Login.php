<?php

namespace App\Filament\Auth;

use App\Filament\Forms\UsernameInput;
use App\Models\User;
use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Schemas\Components\Component;
use SensitiveParameter;

/**
 * Signs in with a username or an email address.
 */
class Login extends BaseLogin
{
    protected function getEmailFormComponent(): Component
    {
        return UsernameInput::make()
            ->autocomplete('username')
            ->autofocus();
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function getCredentialsFromFormData(#[SensitiveParameter] array $data): array
    {
        $credentials = parent::getCredentialsFromFormData($data);
        $user = User::findByLogin($credentials['email']);

        return $user === null ? $credentials : [...$credentials, 'email' => $user->email];
    }
}
