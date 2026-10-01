<?php

namespace Tests\Feature\Filament;

use Filament\Auth\Pages\EditProfile;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

class ProfileTest extends AdminTestCase
{
    private const NEW_PASSWORD = 'a-new-long-password';

    public function test_the_profile_page_opens_inside_the_panel(): void
    {
        $this->get('/admin/profile')->assertOk()->assertSee('Profile');
    }

    public function test_an_admin_changes_their_password_with_the_current_one(): void
    {
        Livewire::test(EditProfile::class)
            ->fillForm([
                'password' => self::NEW_PASSWORD,
                'passwordConfirmation' => self::NEW_PASSWORD,
                'currentPassword' => 'password',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertTrue(Hash::check(self::NEW_PASSWORD, (string) $this->admin->fresh()?->password));
    }

    public function test_a_wrong_current_password_is_rejected(): void
    {
        Livewire::test(EditProfile::class)
            ->fillForm([
                'password' => self::NEW_PASSWORD,
                'passwordConfirmation' => self::NEW_PASSWORD,
                'currentPassword' => 'not-my-password',
            ])
            ->call('save')
            ->assertHasFormErrors(['currentPassword']);

        $this->assertTrue(Hash::check('password', (string) $this->admin->fresh()?->password));
    }

    public function test_the_confirmation_must_match(): void
    {
        Livewire::test(EditProfile::class)
            ->fillForm([
                'password' => self::NEW_PASSWORD,
                'passwordConfirmation' => 'something-else-entirely',
                'currentPassword' => 'password',
            ])
            ->call('save')
            ->assertHasFormErrors(['password']);
    }

    public function test_short_passwords_are_rejected(): void
    {
        Livewire::test(EditProfile::class)
            ->fillForm([
                'password' => 'short-pass',
                'passwordConfirmation' => 'short-pass',
                'currentPassword' => 'password',
            ])
            ->call('save')
            ->assertHasFormErrors(['password']);

        $this->assertTrue(Hash::check('password', (string) $this->admin->fresh()?->password));
    }
}
