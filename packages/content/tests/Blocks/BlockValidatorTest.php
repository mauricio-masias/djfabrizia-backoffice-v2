<?php

namespace Djfabrizia\Content\Tests\Blocks;

use Djfabrizia\Content\Blocks\BlockType;
use Djfabrizia\Content\Blocks\BlockValidator;
use Djfabrizia\Content\Enums\PageTemplate;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class BlockValidatorTest extends TestCase
{
    /**
     * @return array<string, array{PageTemplate}>
     */
    public static function templates(): array
    {
        $cases = [];

        foreach (PageTemplate::cases() as $template) {
            $cases[$template->value] = [$template];
        }

        return $cases;
    }

    #[DataProvider('templates')]
    public function test_every_template_skeleton_is_valid_for_its_template(PageTemplate $template): void
    {
        $validated = (new BlockValidator)->validate($template, $template->skeleton());

        $this->assertCount(count($template->skeleton()), $validated);
    }

    #[DataProvider('templates')]
    public function test_every_skeleton_block_is_allowed_by_its_template(PageTemplate $template): void
    {
        foreach ($template->skeleton() as $block) {
            $this->assertTrue($template->allows(BlockType::from($block['type'])), $block['type']);
        }
    }

    public function test_it_rejects_a_block_type_the_template_does_not_allow(): void
    {
        $blocks = [['type' => BlockType::EpkProducer->value, 'data' => []]];

        try {
            (new BlockValidator)->validate(PageTemplate::EpkDefault, $blocks);
            $this->fail('Expected a validation error.');
        } catch (ValidationException $exception) {
            $this->assertArrayHasKey('blocks.0.type', $exception->errors());
        }
    }

    public function test_it_reports_block_data_errors_under_the_block_index(): void
    {
        $blocks = [
            ['type' => BlockType::HeroRotator->value, 'data' => ['styles' => ['House']]],
            ['type' => BlockType::CollectionFeed->value, 'data' => ['collection' => 'podcasts', 'per_page' => 0]],
        ];

        try {
            (new BlockValidator)->validate(PageTemplate::Home, $blocks);
            $this->fail('Expected a validation error.');
        } catch (ValidationException $exception) {
            $this->assertArrayHasKey('blocks.1.data.collection', $exception->errors());
            $this->assertArrayHasKey('blocks.1.data.per_page', $exception->errors());
            $this->assertArrayNotHasKey('blocks.0.data.styles', $exception->errors());
        }
    }

    public function test_it_rejects_invalid_linktree_colours(): void
    {
        $this->expectException(ValidationException::class);

        (new BlockValidator)->validate(PageTemplate::Linktree, [
            ['type' => BlockType::Linktree->value, 'data' => ['page_bg' => 'black']],
        ]);
    }

    public function test_it_rejects_items_that_are_not_type_and_data_pairs(): void
    {
        $this->expectException(ValidationException::class);

        (new BlockValidator)->validate(PageTemplate::Home, [['type' => 'hero_rotator', 'data' => [], 'extra' => 1]]);
    }

    public function test_it_drops_data_keys_that_have_no_rule(): void
    {
        $validated = (new BlockValidator)->validate(PageTemplate::Social, [
            ['type' => BlockType::SocialPanel->value, 'data' => ['title' => 'Social', 'twitter_id' => 'legacy']],
        ]);

        $this->assertSame(['title' => 'Social'], $validated[0]['data']);
    }
}
