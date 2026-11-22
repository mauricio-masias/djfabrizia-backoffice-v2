<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

/**
 * A back office user. Only admins can open the panel. `is_admin` is left out of
 * the fillable list on purpose, so it can never be mass-assigned from a form.
 *
 * @property int $id
 * @property string $name
 * @property string $email A username or an email address; see findByLogin().
 * @property bool $is_admin
 */
#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $attributes = [
        'is_admin' => false,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * The user who signs in with this username or email address.
     *
     * The email column holds either. A username that is not stored as such
     * also matches the part of an address before the "@", unless two users
     * share it: then only their full addresses work.
     */
    public static function findByLogin(string $login): ?self
    {
        $login = Str::lower($login);
        $exact = self::query()->where('email', $login)->first();

        if ($exact !== null || str_contains($login, '@')) {
            return $exact;
        }

        // LIKE treats an underscore in the username as a wildcard, so the
        // rows it finds are compared again.
        $matches = self::query()
            ->where('email', 'like', $login.'@%')
            ->get()
            ->filter(fn (self $user): bool => Str::lower(Str::before($user->email, '@')) === $login);

        return $matches->count() === 1 ? $matches->first() : null;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_admin;
    }
}
