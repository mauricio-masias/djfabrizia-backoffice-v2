<?php

namespace App\Filament\Auth;

use App\Filament\Forms\UsernameInput;
use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Schemas\Components\Component;

class EditProfile extends BaseEditProfile
{
    protected function getEmailFormComponent(): Component
    {
        return UsernameInput::make()
            ->unique(ignoreRecord: true)
            ->live(debounce: 500);
    }
}
