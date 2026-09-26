<?php

namespace Djfabrizia\Content\Tests\Models;

use Djfabrizia\Content\Models\Country;
use Djfabrizia\Content\Models\Genre;
use Djfabrizia\Content\Models\Link;
use Djfabrizia\Content\Models\LinkSection;
use Djfabrizia\Content\Models\MenuItem;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Release;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class RelationsTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_country_cities_and_clubs_are_ordered_by_sort(): void
    {
        $country = Country::factory()->withCities(3, 2)->create();

        $country->load('cities.clubs');

        $this->assertSame([0, 1, 2], $country->cities->pluck('sort')->all());
        $this->assertSame([0, 1], $country->cities->first()?->clubs->pluck('sort')->all());
    }

    public function test_deleting_a_country_deletes_its_cities_and_clubs(): void
    {
        $country = Country::factory()->withCities(1, 2)->create();
        $city = $country->cities()->firstOrFail();

        $country->delete();

        $this->assertModelMissing($city);
        $this->assertDatabaseCount('clubs', 0);
    }

    public function test_menu_items_nest_under_a_parent(): void
    {
        $parent = MenuItem::factory()->create();
        $child = MenuItem::factory()->nested($parent)->create();

        $this->assertTrue($parent->children()->firstOrFail()->is($child));
        $this->assertSame($parent->menu_id, $child->menu_id);
    }

    public function test_release_links_are_ordered_and_the_label_is_loaded(): void
    {
        $release = Release::factory()->withLinks()->create();

        $release->load(['links', 'recordLabel']);

        $this->assertSame([0, 1, 2, 3], $release->links->pluck('sort')->all());
        $this->assertNotNull($release->recordLabel);
    }

    public function test_mixes_and_releases_share_genres(): void
    {
        $genre = Genre::factory()->create();
        $mix = Mix::factory()->create();
        $release = Release::factory()->create(['primary_genre_id' => $genre->id]);
        $mix->genres()->attach($genre);
        $release->genres()->attach($genre);

        $this->assertTrue($genre->mixes()->firstOrFail()->is($mix));
        $this->assertTrue($genre->releases()->firstOrFail()->is($release));
        $this->assertTrue($genre->primaryReleases()->firstOrFail()->is($release));
    }

    public function test_a_link_can_belong_to_several_sections(): void
    {
        $link = Link::factory()->create();
        $sections = LinkSection::factory()->count(2)->create();

        $link->sections()->attach($sections);

        $this->assertCount(2, $link->sections);
        $this->assertTrue($sections[0]->links()->firstOrFail()->is($link));
    }

    public function test_a_menu_item_cannot_be_its_own_parent(): void
    {
        $item = MenuItem::factory()->create();

        $item->update(['parent_id' => $item->id]);

        $this->assertNull($item->fresh()?->parent_id);
    }
}
