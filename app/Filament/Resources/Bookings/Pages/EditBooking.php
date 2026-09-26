<?php

namespace App\Filament\Resources\Bookings\Pages;

use App\Filament\Resources\Bookings\BookingResource;
use Djfabrizia\Content\Enums\BookingStatus;
use Djfabrizia\Content\Models\Booking;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Icons\Heroicon;

class EditBooking extends EditRecord
{
    protected static string $resource = BookingResource::class;

    /**
     * Opening an unread booking marks it as read.
     */
    public function mount(int|string $record): void
    {
        parent::mount($record);

        $booking = $this->getRecord();

        if ($booking instanceof Booking && $booking->status === BookingStatus::Unread) {
            $booking->update(['status' => BookingStatus::Read]);
            $this->refreshFormData(['status']);
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('reply')
                ->icon(Heroicon::OutlinedEnvelope)
                ->url(fn (Booking $record): string => 'mailto:'.$record->email.'?subject='.rawurlencode('Re: your booking request')),
            DeleteAction::make(),
        ];
    }
}
