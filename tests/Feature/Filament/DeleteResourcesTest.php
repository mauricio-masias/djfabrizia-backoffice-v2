<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\Countries\Pages\EditCountry;
use App\Filament\Resources\Genres\Pages\EditGenre;
use App\Filament\Resources\Links\Pages\EditLink;
use App\Filament\Resources\Mixes\Pages\EditMix;
use App\Filament\Resources\Mixes\Pages\ListMixes;
use App\Filament\Resources\Playlists\Pages\EditPlaylist;
use App\Filament\Resources\Releases\Pages\EditRelease;
use App\Filament\Resources\SocialLinks\Pages\EditSocialLink;
use App\Filament\Resources\UkVenues\Pages\EditUkVenue;
use App\Filament\Resources\Videos\Pages\EditVideo;
use Djfabrizia\Content\Blocks\BlockType;
use Djfabrizia\Content\Models\Country;
use Djfabrizia\Content\Models\Genre;
use Djfabrizia\Content\Models\Link;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Page;
use Djfabrizia\Content\Models\Playlist;
use Djfabrizia\Content\Models\Release;
use Djfabrizia\Content\Models\SocialLink;
use Djfabrizia\Content\Models\UkVenue;
use Djfabrizia\Content\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;

class DeleteResourcesTest extends AdminTestCase
{
    /**
     * @return array<string, array{class-string, class-string<Model>}>
     */
    public static function resources(): array
    {
        return [
            'mix' => [EditMix::class, Mix::class],
            'release' => [EditRelease::class, Release::class],
            'playlist' => [EditPlaylist::class, Playlist::class],
            'video' => [EditVideo::class, Video::class],
            'genre' => [EditGenre::class, Genre::class],
            'country' => [EditCountry::class, Country::class],
            'uk venue' => [EditUkVenue::class, UkVenue::class],
            'social link' => [EditSocialLink::class, SocialLink::class],
            'linktree link' => [EditLink::class, Link::class],
        ];
    }

    /**
     * @param  class-string  $page
     * @param  class-string<Model>  $model
     */
    #[DataProvider('resources')]
    public function test_each_resource_can_be_deleted_from_its_edit_page(string $page, string $model): void
    {
        $record = $model::factory()->create();

        Livewire::test($page, ['record' => $record->getRouteKey()])->callAction('delete');

        $this->assertModelMissing($record);
    }

    public function test_deleting_a_mix_used_on_a_page_is_refused_with_a_message(): void
    {
        $mix = Mix::factory()->create();
        Page::factory()->create(['slug' => 'epk-en', 'blocks' => [['type' => BlockType::EpkMixes->value, 'data' => ['items' => [['mix_id' => $mix->id]]]]]]);

        Livewire::test(EditMix::class, ['record' => $mix->getRouteKey()])
            ->callAction('delete')
            ->assertNotified('Cannot delete');

        $this->assertModelExists($mix);
    }

    public function test_bulk_deleting_a_mix_used_on_a_page_keeps_it(): void
    {
        $used = Mix::factory()->create();
        $free = Mix::factory()->create();
        Page::factory()->create(['blocks' => [['type' => BlockType::EpkMixes->value, 'data' => ['items' => [['mix_id' => $used->id]]]]]]);

        Livewire::test(ListMixes::class)->callTableBulkAction('delete', [$used, $free]);

        $this->assertModelExists($used);
        $this->assertModelMissing($free);
    }
}
