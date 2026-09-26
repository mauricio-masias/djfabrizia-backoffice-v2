<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\Mixes\Pages\CreateMix;
use App\Filament\Resources\Mixes\Pages\EditMix;
use App\Filament\Resources\Mixes\Pages\ListMixes;
use App\Filament\Resources\Playlists\Pages\ListPlaylists;
use App\Filament\Resources\Releases\Pages\CreateRelease;
use App\Filament\Resources\Releases\Pages\EditRelease;
use App\Filament\Resources\Releases\Pages\ListReleases;
use App\Filament\Resources\Videos\Pages\CreateVideo;
use App\Filament\Resources\Videos\Pages\ListVideos;
use Djfabrizia\Content\Enums\ContentSource;
use Djfabrizia\Content\Enums\CoverSource;
use Djfabrizia\Content\Enums\PublishStatus;
use Djfabrizia\Content\Enums\ReleasePlatform;
use Djfabrizia\Content\Models\Genre;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Playlist;
use Djfabrizia\Content\Models\RecordLabel;
use Djfabrizia\Content\Models\Release;
use Djfabrizia\Content\Models\Video;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

class MusicResourcesTest extends AdminTestCase
{
    public function test_collection_lists_render_their_records(): void
    {
        $mixes = Mix::factory()->count(3)->published()->create();
        $releases = Release::factory()->count(2)->create();
        $playlists = Playlist::factory()->count(2)->create();
        $videos = Video::factory()->count(2)->create();

        Livewire::test(ListMixes::class)->assertCanSeeTableRecords($mixes);
        Livewire::test(ListReleases::class)->assertCanSeeTableRecords($releases);
        Livewire::test(ListPlaylists::class)->assertCanSeeTableRecords($playlists);
        Livewire::test(ListVideos::class)->assertCanSeeTableRecords($videos);
    }

    public function test_a_manual_mix_can_be_created_with_genres(): void
    {
        $genre = Genre::factory()->create();

        Livewire::test(CreateMix::class)
            ->fillForm([
                'title' => 'Sunset Session',
                'url' => '/djfabrizia/sunset-session/',
                'genres' => [$genre->id],
                'status' => PublishStatus::Published->value,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $mix = Mix::query()->where('title', 'Sunset Session')->firstOrFail();
        $this->assertSame(ContentSource::Manual, $mix->source);
        $this->assertTrue($mix->genres->contains($genre));
    }

    public function test_upstream_fields_of_a_synced_mix_are_read_only(): void
    {
        $mix = Mix::factory()->create(['title' => 'From Mixcloud']);

        Livewire::test(EditMix::class, ['record' => $mix->getRouteKey()])
            ->assertFormFieldDisabled('title')
            ->assertFormFieldDisabled('url')
            ->fillForm(['status' => PublishStatus::Published->value, 'short_name' => 'Short'])
            ->call('save')
            ->assertHasNoFormErrors();

        $mix->refresh();
        $this->assertSame('From Mixcloud', $mix->title);
        $this->assertSame('Short', $mix->short_name);
        $this->assertSame(PublishStatus::Published, $mix->status);
    }

    public function test_publish_bulk_action_publishes_the_selected_rows(): void
    {
        $mixes = Mix::factory()->count(2)->draft()->create();

        Livewire::test(ListMixes::class)->callTableBulkAction('publish', $mixes);

        $this->assertSame(2, Mix::query()->published()->count());
    }

    public function test_a_release_is_created_with_an_uploaded_cover_and_store_links(): void
    {
        Storage::fake('public');
        Queue::fake();
        $label = RecordLabel::factory()->create();

        Livewire::test(CreateRelease::class)
            ->fillForm([
                'title' => 'Deep Waters (Original Mix)',
                'record_label_id' => $label->id,
                'cover_source' => CoverSource::Local->value,
                'cover_media_id' => UploadedFile::fake()->image('cover.jpg', 800, 800),
                'links' => [
                    ['platform' => ReleasePlatform::Spotify->value, 'label' => 'Spotify', 'url' => 'https://open.spotify.com/track/1'],
                    ['platform' => ReleasePlatform::Traxsource->value, 'label' => 'Traxsource', 'url' => 'https://www.traxsource.com/track/1'],
                ],
                'status' => PublishStatus::Draft->value,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $release = Release::query()->with(['coverMedia', 'links'])->where('title', 'Deep Waters (Original Mix)')->firstOrFail();
        $this->assertNotNull($release->coverMedia);
        Storage::disk('public')->assertExists($release->coverMedia->path);
        $this->assertSame([ReleasePlatform::Spotify, ReleasePlatform::Traxsource], $release->links->pluck('platform')->all());
    }

    public function test_a_release_store_link_must_have_a_valid_url(): void
    {
        $release = Release::factory()->create();

        Livewire::test(EditRelease::class, ['record' => $release->getRouteKey()])
            ->fillForm(['links' => [['platform' => ReleasePlatform::Spotify->value, 'url' => 'not a url']]])
            ->call('save')
            ->assertHasFormErrors();
    }

    public function test_video_ids_must_look_like_youtube_ids_and_be_unique(): void
    {
        Video::factory()->create(['youtube_id' => 'L_2sQhuj8bI']);

        Livewire::test(CreateVideo::class)
            ->fillForm(['title' => 'Duplicate', 'youtube_id' => 'L_2sQhuj8bI', 'status' => 'draft'])
            ->call('create')
            ->assertHasFormErrors(['youtube_id' => 'unique']);

        Livewire::test(CreateVideo::class)
            ->fillForm(['title' => 'Bad', 'youtube_id' => 'not-an-id', 'status' => 'draft'])
            ->call('create')
            ->assertHasFormErrors(['youtube_id' => 'regex']);
    }
}
