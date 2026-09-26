<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Enums\BookingStatus;
use Djfabrizia\Content\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'message' => fake()->paragraphs(2, true),
            'status' => BookingStatus::Unread,
            'ip' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
            'legacy_key' => null,
        ];
    }

    public function read(): static
    {
        return $this->state(fn (): array => ['status' => BookingStatus::Read]);
    }

    public function archived(): static
    {
        return $this->state(fn (): array => ['status' => BookingStatus::Archived]);
    }
}
