<?php

namespace Djfabrizia\Content\Tests\Legacy;

use Djfabrizia\Content\Enums\PageTemplate;
use Djfabrizia\Content\Legacy\EpkLegacyMap;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class EpkLegacyMapTest extends TestCase
{
    /**
     * @return array<string, array{PageTemplate}>
     */
    public static function epkTemplates(): array
    {
        return [
            'default' => [PageTemplate::EpkDefault],
            'special' => [PageTemplate::EpkSpecial],
            'underground' => [PageTemplate::EpkUnderground],
        ];
    }

    #[DataProvider('epkTemplates')]
    public function test_every_entry_targets_an_allowed_block_and_a_field_it_defines(PageTemplate $template): void
    {
        foreach (EpkLegacyMap::for($template) as $entry) {
            $this->assertTrue($template->allows($entry['block']), "{$entry['legacy']}: {$entry['block']->value} not allowed on {$template->value}");

            $root = explode('.', $entry['field'])[0];
            $rules = array_map(fn (string $path): string => explode('.', $path)[0], array_keys($entry['block']->definition()->rules()));
            $this->assertContains($root, $rules, "{$entry['legacy']}: field {$entry['field']} missing from {$entry['block']->value}");
        }
    }

    #[DataProvider('epkTemplates')]
    public function test_each_legacy_field_is_mapped_at_most_once(PageTemplate $template): void
    {
        $legacy = array_column(EpkLegacyMap::for($template), 'legacy');

        $this->assertSame($legacy, array_values(array_unique($legacy)));
    }

    #[DataProvider('epkTemplates')]
    public function test_text_sections_are_only_mapped_with_a_role(PageTemplate $template): void
    {
        $withoutRole = array_filter(
            EpkLegacyMap::for($template),
            fn (array $entry): bool => $entry['block']->value === 'epk_text_section' && $entry['role'] === null,
        );

        $this->assertSame([], array_column($withoutRole, 'legacy'));
    }

    public function test_non_epk_templates_have_no_map(): void
    {
        $this->assertSame([], EpkLegacyMap::for(PageTemplate::Home));
    }
}
