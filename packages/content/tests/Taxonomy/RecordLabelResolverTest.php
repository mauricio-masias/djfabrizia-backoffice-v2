<?php

namespace Djfabrizia\Content\Tests\Taxonomy;

use Djfabrizia\Content\Taxonomy\RecordLabelResolver;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class RecordLabelResolverTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_case_and_spacing_variants_resolve_to_one_label(): void
    {
        $resolver = new RecordLabelResolver;

        $label = $resolver->resolve(' On Circle Music ');

        $this->assertTrue($resolver->resolve('on circle music')?->is($label));
        $this->assertSame('On Circle Music', $label?->name);
        $this->assertDatabaseCount('record_labels', 1);
    }

    public function test_near_duplicates_stay_separate_for_editors_to_merge(): void
    {
        $resolver = new RecordLabelResolver;

        $resolver->resolve('On circle');
        $resolver->resolve('On Circle Music');

        $this->assertDatabaseCount('record_labels', 2);
    }

    public function test_blank_names_resolve_to_nothing(): void
    {
        $this->assertNull((new RecordLabelResolver)->resolve(''));
    }
}
