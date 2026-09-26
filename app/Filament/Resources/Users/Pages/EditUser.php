<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()->hidden(fn (User $record): bool => $record->is(Auth::user())),
        ];
    }

    /**
     * `is_admin` is not mass-assignable, and admins cannot remove their own access.
     *
     * @param  array<string, mixed>  $data
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->fill(collect($data)->except('is_admin')->all());

        if (array_key_exists('is_admin', $data) && ! $record->is(Auth::user())) {
            $record->forceFill(['is_admin' => (bool) $data['is_admin']]);
        }

        $record->save();

        return $record;
    }
}
