<?php

namespace Djfabrizia\Content\Database\Factories;

use Djfabrizia\Content\Enums\SyncProvider;
use Djfabrizia\Content\Enums\SyncStatus;
use Djfabrizia\Content\Models\SyncRun;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SyncRun>
 */
class SyncRunFactory extends Factory
{
    protected $model = SyncRun::class;

    public function definition(): array
    {
        $started = fake()->dateTimeBetween('-1 week');

        return [
            'provider' => fake()->randomElement(SyncProvider::cases()),
            'status' => SyncStatus::Success,
            'started_at' => $started,
            'finished_at' => (clone $started)->modify('+'.fake()->numberBetween(2, 90).' seconds'),
            'created' => fake()->numberBetween(0, 5),
            'updated' => fake()->numberBetween(0, 50),
            'missing' => 0,
            'error' => null,
        ];
    }

    public function failed(string $error = 'Upstream API returned 500'): static
    {
        return $this->state(fn (): array => [
            'status' => SyncStatus::Failed,
            'error' => $error,
        ]);
    }
}
