<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Creates the first admin from config('cms.admin'), or updates its name and
 * password when the email already exists.
 */
class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = config('cms.admin.email');
        $password = config('cms.admin.password');

        if (! is_string($email) || $email === '' || ! is_string($password) || $password === '') {
            $this->command->warn('CMS_ADMIN_EMAIL / CMS_ADMIN_PASSWORD not set: admin user skipped.');

            return;
        }

        $user = User::query()->firstOrNew(['email' => $email]);
        $user->forceFill([
            'name' => (string) config('cms.admin.name', 'Admin'),
            'password' => $password,
            'is_admin' => true,
        ])->save();
    }
}
