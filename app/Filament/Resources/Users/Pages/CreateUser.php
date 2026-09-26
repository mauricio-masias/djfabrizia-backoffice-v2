<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    /**
     * `is_admin` is not mass-assignable, so it is set explicitly.
     *
     * @param  array<string, mixed>  $data
     */
    protected function handleRecordCreation(array $data): Model
    {
        $user = new User;
        $user->fill(collect($data)->except('is_admin')->all());
        $user->forceFill(['is_admin' => (bool) ($data['is_admin'] ?? false)])->save();

        return $user;
    }
}
