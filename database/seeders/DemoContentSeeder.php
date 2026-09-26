<?php

namespace Database\Seeders;

use Djfabrizia\Content\Blocks\BlockType;
use Djfabrizia\Content\Enums\LinkMedia;
use Djfabrizia\Content\Enums\PublishStatus;
use Djfabrizia\Content\Models\Booking;
use Djfabrizia\Content\Models\Country;
use Djfabrizia\Content\Models\Genre;
use Djfabrizia\Content\Models\Link;
use Djfabrizia\Content\Models\LinkSection;
use Djfabrizia\Content\Models\Media;
use Djfabrizia\Content\Models\Menu;
use Djfabrizia\Content\Models\MenuItem;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Page;
use Djfabrizia\Content\Models\Playlist;
use Djfabrizia\Content\Models\Release;
use Djfabrizia\Content\Models\SocialLink;
use Djfabrizia\Content\Models\UkVenue;
use Djfabrizia\Content\Models\Video;
use Illuminate\Database\Seeder;
use RuntimeException;

/**
 * Faker-generated demo content for local development and tests. Never runs in
 * other environments: real content comes from the WordPress importer.
 */
class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->environment(['local', 'testing'])) {
            throw new RuntimeException('DemoContentSeeder only runs in the local and testing environments.');
        }

        $genres = Genre::factory()->count(10)->create();

        Mix::factory()->count(40)->published()->create()
            ->each(fn (Mix $mix) => $mix->genres()->attach($genres->random(3)));

        Release::factory()->count(15)->published()->withExternalCover()->withLinks()->create()
            ->each(function (Release $release) use ($genres): void {
                $release->update(['primary_genre_id' => $genres->random()->id]);
            });

        Playlist::factory()->count(12)->published()->create();
        Video::factory()->count(50)->published()->create();

        Country::factory()->count(7)->withCities(2, 3)->create();
        Country::factory()->default()->withCities(3, 4)->create(['name' => 'United Kingdom']);

        UkVenue::factory()->count(20)->sequence(fn ($sequence) => ['sort' => $sequence->index])->create();

        $this->seedMenus();
        $this->seedSocialAndLinktree();

        Booking::factory()->count(6)->create();
        Booking::factory()->count(3)->read()->create();
        Booking::factory()->archived()->create();

        $this->fillPages();
    }

    private function seedMenus(): void
    {
        foreach (Menu::query()->get() as $menu) {
            foreach (['Mixes', 'Releases', 'Playlists', 'Videos', 'Bio', 'Contact me'] as $sort => $title) {
                MenuItem::factory()->for($menu)->create([
                    'title' => $title,
                    'url' => '/'.str($title)->slug(),
                    'sort' => $sort,
                ]);
            }

            MenuItem::factory()->for($menu)->external()->icon('instagram')->create([
                'title' => 'Instagram',
                'url' => 'https://www.instagram.com/djfabrizia',
                'sort' => 10,
            ]);
        }
    }

    private function seedSocialAndLinktree(): void
    {
        foreach (['Instagram', 'Facebook', 'Youtube', 'Mixcloud', 'Spotify'] as $sort => $network) {
            SocialLink::factory()->create([
                'network' => $network,
                'icon_class' => 'fa-'.strtolower($network),
                'url' => 'https://www.'.strtolower($network).'.com/djfabrizia',
                'sort' => $sort,
            ]);
        }

        $gigs = LinkSection::factory()->create(['label' => 'RECENT GIGS', 'sort' => 0]);
        $listen = LinkSection::factory()->create(['label' => 'LISTEN', 'sort' => 1]);

        Link::factory()->count(3)->sequence(fn ($sequence) => ['sort' => $sequence->index])->create()
            ->each(fn (Link $link) => $link->sections()->attach($gigs));

        Link::factory()->platform(LinkMedia::Mixcloud)->create(['sort' => 10])->sections()->attach($listen);
        Link::factory()->customHandle(LinkMedia::SpotifyCustom)->create(['sort' => 11])->sections()->attach($listen);
    }

    /**
     * Put demo values into the reference pages' skeleton blocks and publish them.
     */
    private function fillPages(): void
    {
        $mixIds = Mix::query()->inRandomOrder()->limit(4)->pluck('id');
        $imageId = Media::factory()->create()->id;

        foreach (Page::query()->get() as $page) {
            $blocks = array_map(function (array $block) use ($mixIds, $imageId): array {
                $block['data'] = match ($block['type']) {
                    BlockType::HeroRotator->value => ['styles' => ['DJ - Producer in London', 'House', 'Deep house', 'Tech house', 'Techno']],
                    BlockType::RichTwoColumn->value => array_replace($block['data'], ['title' => fake()->sentence(2), 'left' => fake()->paragraph(), 'right' => fake()->paragraph()]),
                    BlockType::CollectionFeed->value => array_replace($block['data'], ['title' => ucfirst((string) $block['data']['collection']), 'more_label' => 'More']),
                    BlockType::Booking->value => array_replace($block['data'], ['title' => 'Book me', 'left' => fake()->paragraph(), 'right' => fake()->paragraph(), 'success' => 'Thanks, I will be in touch.']),
                    BlockType::Linktree->value => array_replace($block['data'], ['hero_media_id' => $imageId, 'title' => 'DJ Fabrizia', 'teaser' => fake()->sentence()]),
                    BlockType::EpkMixes->value => ['title' => 'Mixes', 'items' => $mixIds->map(fn (int $id): array => ['label' => fake()->words(2, true), 'mix_id' => $id])->all()],
                    BlockType::LegalContent->value => ['html' => '<p>'.fake()->paragraph().'</p><p>'.fake()->paragraph().'</p>'],
                    default => $block['data'],
                };

                return $block;
            }, $page->blocks);

            $page->update([
                'blocks' => $blocks,
                'status' => PublishStatus::Published,
                'published_at' => now()->subDay(),
            ]);
        }
    }
}
