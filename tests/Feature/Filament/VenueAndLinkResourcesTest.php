<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\Countries\Pages\CreateCountry;
use App\Filament\Resources\Links\Pages\CreateLink;
use App\Filament\Resources\Menus\MenuResource;
use App\Filament\Resources\Menus\Pages\EditMenu;
use App\Filament\Resources\Menus\Pages\ListMenus;
use App\Filament\Resources\SocialLinks\Pages\ListSocialLinks;
use App\Filament\Resources\UkVenues\Pages\ListUkVenues;
use Djfabrizia\Content\Enums\LinkMedia;
use Djfabrizia\Content\Models\Country;
use Djfabrizia\Content\Models\Link;
use Djfabrizia\Content\Models\LinkSection;
use Djfabrizia\Content\Models\Menu;
use Djfabrizia\Content\Models\MenuItem;
use Djfabrizia\Content\Models\SocialLink;
use Djfabrizia\Content\Models\UkVenue;
use Livewire\Livewire;

class VenueAndLinkResourcesTest extends AdminTestCase
{
    public function test_a_country_is_created_with_nested_cities_and_clubs(): void
    {
        Livewire::test(CreateCountry::class)
            ->fillForm([
                'name' => 'Italy',
                'is_default' => true,
                'cities' => [
                    ['name' => 'Milan', 'clubs' => [['name' => 'Plastic'], ['name' => 'Magazzini Generali']]],
                    ['name' => 'Rome', 'clubs' => [['name' => 'Goa']]],
                ],
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $country = Country::query()->with('cities.clubs')->where('name', 'Italy')->firstOrFail();
        $this->assertSame(['Milan', 'Rome'], $country->cities->pluck('name')->all());
        $this->assertSame(['Plastic', 'Magazzini Generali'], $country->cities->first()?->clubs->pluck('name')->all());
        $this->assertTrue($country->is_default);
    }

    public function test_uk_venues_and_social_links_are_listed_in_sort_order(): void
    {
        $venues = UkVenue::factory()->count(3)->sequence(fn ($sequence) => ['sort' => 2 - $sequence->index])->create();
        $links = SocialLink::factory()->count(2)->create();

        Livewire::test(ListUkVenues::class)->assertCanSeeTableRecords($venues->sortBy('sort'), inOrder: true);
        Livewire::test(ListSocialLinks::class)->assertCanSeeTableRecords($links);
    }

    public function test_menus_cannot_be_created_or_deleted_but_their_items_can_be_edited(): void
    {
        $menu = Menu::factory()->create(['slug' => 'main']);
        $home = MenuItem::factory()->for($menu)->create(['title' => 'Home', 'sort' => 0]);

        $this->assertFalse(MenuResource::hasPage('create'));
        Livewire::test(ListMenus::class)->assertCanSeeTableRecords([$menu]);

        Livewire::test(EditMenu::class, ['record' => $menu->getRouteKey()])
            ->assertActionDoesNotExist('delete')
            ->fillForm([
                'items' => [
                    "record-{$home->id}" => ['title' => 'Home', 'url' => '/', 'target' => '_self', 'icon' => null, 'parent_id' => null],
                    'new-item' => ['title' => 'Mixes', 'url' => '/mixes', 'target' => '_self', 'icon' => null, 'parent_id' => $home->id],
                ],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertSame(['Home', 'Mixes'], $menu->items()->pluck('title')->all());
        $this->assertSame($home->id, $menu->items()->where('title', 'Mixes')->value('parent_id'));
        $this->assertModelExists($home);
    }

    public function test_a_custom_handle_link_requires_the_account_name(): void
    {
        $section = LinkSection::factory()->create();

        Livewire::test(CreateLink::class)
            ->fillForm(['media' => LinkMedia::SpotifyCustom->value, 'url' => null, 'sections' => [$section->id]])
            ->call('create')
            ->assertHasFormErrors(['url' => 'required']);

        Livewire::test(CreateLink::class)
            ->fillForm(['media' => LinkMedia::SpotifyCustom->value, 'url' => 'another-artist', 'description' => 'Listen', 'sections' => [$section->id]])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertTrue(Link::query()->where('url', 'another-artist')->firstOrFail()->sections->contains($section));
    }

    public function test_a_platform_link_needs_no_url(): void
    {
        $section = LinkSection::factory()->create();

        Livewire::test(CreateLink::class)
            ->fillForm(['media' => LinkMedia::Mixcloud->value, 'description' => 'Mixcloud', 'sections' => [$section->id]])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertNull(Link::query()->where('media', LinkMedia::Mixcloud->value)->firstOrFail()->url);
    }
}
