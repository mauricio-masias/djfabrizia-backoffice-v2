<?php

namespace Tests\Feature\Filament;

use App\Events\ContentChanged;
use App\Filament\Resources\Genres\Pages\CreateGenre;
use App\Filament\Resources\Genres\Pages\ListGenres;
use App\Filament\Resources\RecordLabels\Pages\ListRecordLabels;
use Djfabrizia\Content\Models\Genre;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\RecordLabel;
use Djfabrizia\Content\Models\Release;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;

class TaxonomyResourcesTest extends AdminTestCase
{
    public function test_merging_genres_moves_mixes_releases_and_keeps_the_old_names_as_aliases(): void
    {
        $keep = Genre::factory()->create(['name' => 'Tech House', 'slug' => 'tech-house']);
        $duplicate = Genre::factory()->unreviewed()->create(['name' => 'TechHouse', 'slug' => 'techhouse-dup']);
        $mix = Mix::factory()->create();
        $shared = Mix::factory()->create();
        $release = Release::factory()->create(['primary_genre_id' => $duplicate->id]);
        $mix->genres()->attach($duplicate);
        $shared->genres()->attach([$keep->id, $duplicate->id]);

        Event::fake([ContentChanged::class]);

        Livewire::test(ListGenres::class)
            ->callTableBulkAction('merge', [$keep, $duplicate], ['target' => $keep->id])
            ->assertNotified();

        Event::assertDispatched(ContentChanged::class, fn (ContentChanged $event): bool => $event->topics === ['genres', 'mixes', 'releases']);

        $this->assertModelMissing($duplicate);
        $this->assertTrue($mix->genres()->first()?->is($keep));
        $this->assertSame(1, $shared->genres()->count());
        $this->assertSame($keep->id, $release->fresh()?->primary_genre_id);
        $this->assertContains('TechHouse', $keep->fresh()?->aliases ?? []);
    }

    public function test_merging_record_labels_moves_their_releases(): void
    {
        $keep = RecordLabel::factory()->create(['name' => 'On Circle Music']);
        $other = RecordLabel::factory()->create(['name' => 'On circle']);
        $release = Release::factory()->create(['record_label_id' => $other->id]);

        Event::fake([ContentChanged::class]);

        Livewire::test(ListRecordLabels::class)
            ->callTableBulkAction('merge', [$keep, $other], ['target' => $keep->id]);

        Event::assertDispatched(ContentChanged::class, fn (ContentChanged $event): bool => $event->topics === ['releases']);

        $this->assertModelMissing($other);
        $this->assertSame($keep->id, $release->fresh()?->record_label_id);
    }

    public function test_genre_slugs_are_unique(): void
    {
        Genre::factory()->create(['slug' => 'house']);

        Livewire::test(CreateGenre::class)
            ->fillForm(['name' => 'House', 'slug' => 'house'])
            ->call('create')
            ->assertHasFormErrors(['slug' => 'unique']);
    }
}
