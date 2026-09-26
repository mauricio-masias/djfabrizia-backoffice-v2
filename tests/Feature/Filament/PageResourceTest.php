<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\Pages\Pages\CreatePage;
use App\Filament\Resources\Pages\Pages\EditPage;
use App\Filament\Resources\Pages\Pages\ListPages;
use Database\Seeders\ReferenceSeeder;
use Djfabrizia\Content\Blocks\BlockType;
use Djfabrizia\Content\Enums\PageLocale;
use Djfabrizia\Content\Enums\PageTemplate;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Page;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Repeater;
use Livewire\Livewire;

class PageResourceTest extends AdminTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(ReferenceSeeder::class);
    }

    public function test_the_page_list_shows_every_site_page(): void
    {
        Livewire::test(ListPages::class)->assertCanSeeTableRecords(Page::query()->get());
    }

    public function test_editing_blocks_saves_them_in_order(): void
    {
        $undoBuilderFake = Builder::fake();
        $page = Page::query()->where('slug', 'home')->firstOrFail();

        Livewire::test(EditPage::class, ['record' => $page->getRouteKey()])
            ->fillForm([
                'blocks' => [
                    ['type' => BlockType::HeroRotator->value, 'data' => ['styles' => ['House', 'Techno']]],
                    ['type' => BlockType::CollectionFeed->value, 'data' => ['collection' => 'mixes', 'title' => 'Mixes', 'per_page' => 6, 'more_label' => 'More', 'channel_id' => null]],
                ],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $undoBuilderFake();

        $page->refresh();
        $this->assertSame([BlockType::HeroRotator->value, BlockType::CollectionFeed->value], array_column($page->blocks, 'type'));
        $this->assertSame(['House', 'Techno'], $page->blocks[0]['data']['styles']);
    }

    public function test_an_invalid_block_value_is_rejected(): void
    {
        $undoBuilderFake = Builder::fake();
        $page = Page::query()->where('slug', 'home')->firstOrFail();

        Livewire::test(EditPage::class, ['record' => $page->getRouteKey()])
            ->fillForm([
                'blocks' => [
                    ['type' => BlockType::CollectionFeed->value, 'data' => ['collection' => 'mixes', 'per_page' => 500]],
                ],
            ])
            ->call('save')
            ->assertHasFormErrors();

        $undoBuilderFake();

        $this->assertNotSame(500, $page->fresh()?->blocks[0]['data']['per_page'] ?? null);
    }

    public function test_an_epk_page_stores_references_to_mixes(): void
    {
        $undoBuilderFake = Builder::fake();
        $undoRepeaterFake = Repeater::fake();
        $mix = Mix::factory()->create();
        $page = Page::query()->where('slug', 'epk-en')->firstOrFail();

        Livewire::test(EditPage::class, ['record' => $page->getRouteKey()])
            ->fillForm([
                'blocks' => [
                    ['type' => BlockType::EpkMixes->value, 'data' => ['title' => 'Listen', 'items' => [['label' => 'Latest', 'mix_id' => $mix->id]]]],
                ],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $undoBuilderFake();
        $undoRepeaterFake();

        $this->assertSame($mix->id, (int) $page->fresh()?->blocks[0]['data']['items'][0]['mix_id']);
    }

    public function test_a_new_page_starts_from_its_template_skeleton(): void
    {
        Livewire::test(CreatePage::class)
            ->fillForm(['title' => 'Summer EPK', 'slug' => 'summer', 'template' => PageTemplate::Bio->value, 'locale' => 'en', 'status' => 'draft'])
            ->call('create')
            ->assertHasNoFormErrors();

        $page = Page::query()->where('slug', 'summer')->firstOrFail();
        $this->assertSame(array_column(PageTemplate::Bio->skeleton(), 'type'), array_column($page->blocks, 'type'));
    }

    public function test_only_one_epk_page_per_template_and_language(): void
    {
        Livewire::test(CreatePage::class)
            ->fillForm(['title' => 'Another EPK', 'slug' => 'epk-en-2', 'template' => PageTemplate::EpkDefault->value, 'locale' => 'en', 'status' => 'draft'])
            ->call('create')
            ->assertNotified('That EPK already exists');

        $this->assertFalse(Page::query()->where('slug', 'epk-en-2')->exists());
    }

    public function test_duplicating_copies_blocks_into_an_independent_draft(): void
    {
        $page = Page::query()->where('slug', 'bio')->firstOrFail();

        Livewire::test(EditPage::class, ['record' => $page->getRouteKey()])
            ->callAction('duplicate', ['title' => 'Bio IT', 'slug' => 'bio-it', 'locale' => PageLocale::Italian->value]);

        $copy = Page::query()->where('slug', 'bio-it')->firstOrFail();
        $this->assertSame($page->blocks, $copy->blocks);
        $this->assertSame(PageLocale::Italian, $copy->locale);
        $this->assertNull($copy->legacy_wp_id);
        $this->assertFalse($copy->isPublished());
    }

    public function test_duplicating_an_epk_into_a_taken_language_is_refused(): void
    {
        $page = Page::query()->where('slug', 'epk-en')->firstOrFail();

        Livewire::test(EditPage::class, ['record' => $page->getRouteKey()])
            ->callAction('duplicate', ['title' => 'Copy', 'slug' => 'epk-it-copy', 'locale' => PageLocale::Italian->value])
            ->assertNotified('That EPK already exists');

        $this->assertFalse(Page::query()->where('slug', 'epk-it-copy')->exists());
    }

    public function test_site_pages_cannot_be_deleted(): void
    {
        $page = Page::query()->where('slug', 'home')->firstOrFail();

        Livewire::test(EditPage::class, ['record' => $page->getRouteKey()])->assertActionHidden('delete');
    }

    public function test_the_template_offers_only_its_own_components(): void
    {
        $page = Page::query()->where('slug', 'epk-en-underground')->firstOrFail();

        Livewire::test(EditPage::class, ['record' => $page->getRouteKey()])
            ->assertSee(BlockType::EpkProducer->label())
            ->assertDontSee(BlockType::HeroRotator->label());
    }
}
