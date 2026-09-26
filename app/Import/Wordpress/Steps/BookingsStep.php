<?php

namespace App\Import\Wordpress\Steps;

use App\Import\Wordpress\ImportContext;
use Djfabrizia\Content\Enums\BookingStatus;
use Djfabrizia\Content\Models\Booking;
use Illuminate\Support\Carbon;

/**
 * Booking requests stored by Contact Form 7 + CFDB7 (serialized PHP arrays;
 * never unserialized into objects).
 */
class BookingsStep implements ImportStep
{
    public function name(): string
    {
        return 'bookings';
    }

    public function run(ImportContext $context): void
    {
        foreach ($context->source->formSubmissions((int) config('cms.import.booking_form_id')) as $row) {
            $values = self::values($row->form_value);

            if ($values === null) {
                $context->skipped($this->name(), "submission {$row->form_id} could not be read");

                continue;
            }

            $booking = Booking::query()->updateOrCreate(['legacy_key' => "cfdb7:{$row->form_id}"], [
                'name' => (string) ($values['your-name'] ?? ''),
                'email' => (string) $values['your-email'],
                'message' => (string) ($values['your-message'] ?? ''),
                'status' => ($values['cfdb7_status'] ?? 'unread') === 'read' ? BookingStatus::Read : BookingStatus::Unread,
                'created_at' => Carbon::parse($row->form_date),
            ]);

            $context->saved($this->name(), $booking);
        }
    }

    /**
     * The submitted fields, or null when the row is unreadable or has no email.
     *
     * @return array<string, mixed>|null
     */
    public static function values(string $serialized): ?array
    {
        $values = @unserialize($serialized, ['allowed_classes' => false]);

        return is_array($values) && is_string($values['your-email'] ?? null) && $values['your-email'] !== '' ? $values : null;
    }
}
