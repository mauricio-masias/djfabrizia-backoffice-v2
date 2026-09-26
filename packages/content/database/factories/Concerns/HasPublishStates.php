<?php

namespace Djfabrizia\Content\Database\Factories\Concerns;

use Djfabrizia\Content\Enums\PublishStatus;

/**
 * published() / draft() / scheduled() states for publishable models.
 */
trait HasPublishStates
{
    public function published(): static
    {
        return $this->state(fn (): array => [
            'status' => PublishStatus::Published,
            'published_at' => fake()->dateTimeBetween('-3 years', '-1 day'),
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn (): array => [
            'status' => PublishStatus::Draft,
            'published_at' => null,
        ]);
    }

    public function scheduled(): static
    {
        return $this->state(fn (): array => [
            'status' => PublishStatus::Published,
            'published_at' => fake()->dateTimeBetween('+1 day', '+1 month'),
        ]);
    }
}
