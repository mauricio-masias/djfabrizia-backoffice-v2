<?php

namespace App\Import\Wordpress\Steps;

use App\Import\Wordpress\ImportContext;
use Djfabrizia\Content\Models\UkVenue;

/**
 * The Bio page's `uk_venues` repeater, in its stored order.
 */
class UkVenuesStep implements ImportStep
{
    private const BIO_PAGE_ID = 7;

    public function name(): string
    {
        return 'uk_venues';
    }

    public function run(ImportContext $context): void
    {
        $names = $context->source->meta(self::BIO_PAGE_ID)->matching('/^uk_venues_\d+_uk_venue$/');
        $keys = [];

        foreach ($names as $sort => $name) {
            $keys[] = $key = self::BIO_PAGE_ID.":uk_venues:{$sort}";

            $venue = UkVenue::query()->updateOrCreate(['legacy_key' => $key], ['name' => $name, 'sort' => $sort]);
            $context->saved($this->name(), $venue);
        }

        UkVenue::query()->whereNotNull('legacy_key')->whereNotIn('legacy_key', $keys)->delete();
    }
}
