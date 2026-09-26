<?php

namespace Djfabrizia\Content\Models;

use Djfabrizia\Content\Database\Factories\BookingFactory;
use Djfabrizia\Content\Enums\BookingStatus;
use Djfabrizia\Content\Models\Concerns\UsesContentConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * A booking request from the public site. Written by the endpoint, managed in
 * the back office inbox.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property BookingStatus $status
 * @property string|null $ip
 * @property string|null $user_agent
 * @property string|null $legacy_key
 * @property Carbon $created_at
 */
class Booking extends Model
{
    /** @use HasFactory<BookingFactory> */
    use HasFactory, UsesContentConnection;

    protected $fillable = [
        'name',
        'email',
        'message',
        'status',
        'ip',
        'user_agent',
        'legacy_key',
        'created_at',
    ];

    protected $attributes = [
        'status' => 'unread',
    ];

    protected function casts(): array
    {
        return [
            'status' => BookingStatus::class,
        ];
    }

    protected static function newFactory(): BookingFactory
    {
        return BookingFactory::new();
    }
}
