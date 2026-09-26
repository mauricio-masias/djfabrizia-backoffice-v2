<?php

namespace App\Import\Wordpress\Steps;

use App\Import\Wordpress\ImportContext;
use Djfabrizia\Content\Models\City;
use Djfabrizia\Content\Models\Club;
use Djfabrizia\Content\Models\Country;

/**
 * "International" posts → countries, with their city and club repeaters.
 * v1 lists countries alphabetically, so that is the initial sort order.
 */
class CountriesStep implements ImportStep
{
    public function name(): string
    {
        return 'countries';
    }

    public function run(ImportContext $context): void
    {
        $posts = $context->source->posts('international')->sortBy('post_title', SORT_NATURAL | SORT_FLAG_CASE)->values();

        foreach ($posts as $sort => $post) {
            $meta = $context->source->meta($post->ID);

            $country = Country::query()->updateOrCreate(['legacy_wp_id' => $post->ID], [
                'name' => $post->post_title,
                'is_default' => (bool) $meta->int('default_country'),
                'sort' => $sort,
            ]);

            $cityKeys = [];

            foreach ($meta->repeater('country_city', ['city_name', 'club_name']) as $cityIndex => $row) {
                $cityKeys[] = $cityKey = "{$post->ID}:city:{$cityIndex}";

                $city = City::query()->updateOrCreate(['legacy_key' => $cityKey], [
                    'country_id' => $country->id,
                    'name' => (string) $row['city_name'],
                    'sort' => $cityIndex,
                ]);

                $clubKeys = [];

                foreach ($meta->repeater("country_city_{$cityIndex}_club_name", ['item_name']) as $clubIndex => $club) {
                    $clubKeys[] = $clubKey = "{$cityKey}:club:{$clubIndex}";

                    Club::query()->updateOrCreate(['legacy_key' => $clubKey], [
                        'city_id' => $city->id,
                        'name' => (string) $club['item_name'],
                        'sort' => $clubIndex,
                    ]);
                }

                $city->clubs()->whereNotNull('legacy_key')->whereNotIn('legacy_key', $clubKeys)->delete();
            }

            $country->cities()->whereNotNull('legacy_key')->whereNotIn('legacy_key', $cityKeys)->delete();

            $context->saved($this->name(), $country);
        }
    }
}
