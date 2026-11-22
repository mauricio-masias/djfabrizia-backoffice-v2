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
use PHPUnit\Framework\Attributes\DataProvider;
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

    #[TestWith(['dj_fabrizia1'])]
    #[TestWith(['DJ_Fabrizia1'])]
    public function test_a_stored_username_signs_in_whatever_its_case(string $username): void
    {
        $user = User::factory()->admin()->create(['email' => 'dj_fabrizia1']);

        $this->signIn($username)->assertHasNoFormErrors();

        $this->assertAuthenticatedAs($user);
    }

    #[TestWith(['owner@example.com'])]
    #[TestWith(['Owner@Example.com'])]
    #[TestWith(['owner'])]
    #[TestWith(['OWNER'])]
    public function test_a_stored_email_signs_in_in_full_or_by_the_part_before_the_at(string $login): void
    {
        $user = User::factory()->admin()->create(['email' => 'owner@example.com']);

        $this->signIn($login)->assertHasNoFormErrors();

        $this->assertAuthenticatedAs($user);
    }

    public function test_an_exact_username_wins_over_the_start_of_an_email(): void
    {
        User::factory()->admin()->create(['email' => 'owner@example.com']);
        $exact = User::factory()->admin()->create(['email' => 'owner']);

        $this->signIn('owner');

        $this->assertAuthenticatedAs($exact);
    }

    public function test_a_username_shared_by_two_emails_is_refused_but_the_email_still_works(): void
    {
        User::factory()->admin()->create(['email' => 'owner@example.com']);
        $second = User::factory()->admin()->create(['email' => 'owner@example.org']);

        $this->signIn('owner')->assertHasFormErrors(['email']);
        $this->assertGuest();

        $this->signIn('owner@example.org');
        $this->assertAuthenticatedAs($second);
    }

    public function test_an_underscore_is_not_a_wildcard(): void
    {
        User::factory()->admin()->create(['email' => 'djxone@example.com']);

        $this->signIn('dj_one')->assertHasFormErrors(['email']);

        $this->assertGuest();
    }

    public function test_a_wrong_password_is_refused(): void
    {
        User::factory()->admin()->create(['email' => 'owner@example.com']);

        $this->signIn('owner', 'wrong')->assertHasFormErrors(['email']);

        $this->assertGuest();
    }

    public function test_a_user_who_is_not_an_admin_is_refused(): void
    {
        User::factory()->create(['email' => 'visitor']);

        $this->signIn('visitor')->assertHasFormErrors(['email']);

        $this->assertGuest();
    }

    /**
     * @return array<string, array{string}>
     */
    public static function invalidUsernames(): array
    {
        return [
            'space' => ['dj fabrizia'],
            'hyphen' => ['dj-fabrizia'],
            'dot' => ['dj.fabrizia'],
            'accent' => ['fabrizía'],
            'wildcard' => ['dj%'],
            'trailing newline' => ["owner\n"],
            'incomplete email' => ['owner@'],
        ];
    }

    #[DataProvider('invalidUsernames')]
    public function test_other_characters_are_rejected_with_an_explanation(string $username): void
    {
        $this->signIn($username)
            ->assertHasFormErrors(['email'])
            ->assertSee(UsernameInput::MESSAGE);

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

    public function test_the_users_form_rejects_an_invalid_username(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        Livewire::test(CreateUser::class)
            ->fillForm(['name' => 'Editor', 'email' => 'not valid', 'password' => 'a-very-long-password'])
            ->call('create')
            ->assertHasFormErrors(['email']);
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
