<?php

namespace Tests\Feature\Filament;

use App\Filament\Auth\EditProfile;
use App\Filament\Auth\Login;
use App\Filament\Forms\UsernameInput;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_the_login_page_asks_for_a_username(): void
    {
        $this->get('/admin/login')
            ->assertOk()
            ->assertSee('Username')
            ->assertDontSee('Email address')
            // A browser-side email check would reject a username before it is sent.
            ->assertDontSee('type="email"', false);
    }

    #[TestWith(['x1x2x3'])]
    #[TestWith(['x1x2x3@djfabrizia.com'])]
    #[TestWith(['x1-x2.x3'])]
    public function test_the_stored_login_signs_in_whether_or_not_it_is_an_email(string $login): void
    {
        $user = User::factory()->admin()->create(['email' => $login]);

        $this->signIn($login)->assertHasNoFormErrors();

        $this->assertAuthenticatedAs($user);
    }

    #[TestWith(['x1x2x3'])]
    #[TestWith(['Fabrizia'])]
    #[TestWith(['x1x2x3@example.org'])]
    public function test_only_the_exact_email_column_is_matched(string $login): void
    {
        User::factory()->admin()->create(['name' => 'Fabrizia', 'email' => 'x1x2x3@djfabrizia.com']);

        $this->signIn($login)->assertHasFormErrors(['email']);

        $this->assertGuest();
    }

    public function test_a_wrong_password_is_refused(): void
    {
        User::factory()->admin()->create(['email' => 'owner']);

        $this->signIn('owner', 'wrong')->assertHasFormErrors(['email']);

        $this->assertGuest();
    }

    public function test_a_user_who_is_not_an_admin_is_refused(): void
    {
        User::factory()->create(['email' => 'visitor']);

        $this->signIn('visitor')->assertHasFormErrors(['email']);

        $this->assertGuest();
    }

    public function test_the_username_is_required(): void
    {
        $this->signIn('')->assertHasFormErrors(['email' => 'required']);
    }

    public function test_the_users_form_stores_a_username_in_lowercase(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        Livewire::test(CreateUser::class)
            ->assertSee('Username')
            ->fillForm(['name' => 'Editor', 'email' => 'Editor_1', 'password' => 'a-very-long-password', 'is_admin' => true])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertTrue(User::query()->where('email', 'editor_1')->exists());
    }

    #[TestWith(['dj fabrizia'])]
    #[TestWith(['dj-fabrizia'])]
    #[TestWith(['fabrizía'])]
    #[TestWith(["owner\n"])]
    #[TestWith(['owner@'])]
    public function test_the_users_form_rejects_an_invalid_username(string $username): void
    {
        $this->actingAs(User::factory()->admin()->create());

        Livewire::test(CreateUser::class)
            ->fillForm(['name' => 'Editor', 'email' => $username, 'password' => 'a-very-long-password'])
            ->call('create')
            ->assertHasFormErrors(['email'])
            ->assertSee(UsernameInput::MESSAGE);
    }

    public function test_a_user_with_a_username_can_save_their_profile(): void
    {
        $user = User::factory()->admin()->create(['email' => 'owner']);
        $this->actingAs($user);

        Livewire::test(EditProfile::class)
            ->fillForm(['name' => 'Renamed'])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertSame('Renamed', $user->refresh()->name);
        $this->assertSame('owner', $user->email);
    }

    public function test_the_profile_page_rejects_an_invalid_username(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        $this->get('/admin/profile')->assertOk()->assertSeeLivewire(EditProfile::class);

        Livewire::test(EditProfile::class)
            ->fillForm(['email' => 'not valid', 'currentPassword' => 'password'])
            ->call('save')
            ->assertHasFormErrors(['email']);
    }

    /**
     * @return Testable<Login>
     */
    private function signIn(string $username, string $password = 'password'): Testable
    {
        return Livewire::test(Login::class)
            ->fillForm(['email' => $username, 'password' => $password])
            ->call('authenticate');
    }
}
