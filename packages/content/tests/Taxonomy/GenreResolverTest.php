<?php

namespace Djfabrizia\Content\Tests\Taxonomy;

use Djfabrizia\Content\Models\Genre;
use Djfabrizia\Content\Taxonomy\GenreResolver;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class GenreResolverTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_spelling_variants_resolve_to_one_genre(): void
    {
        $resolver = new GenreResolver;

        $genre = $resolver->resolve('Tech house');

        $this->assertTrue($resolver->resolve('TechHouse')?->is($genre));
        $this->assertTrue($resolver->resolve('  Tech   House ')?->is($genre));
        $this->assertTrue($resolver->resolve('tech-house')?->is($genre));
        $this->assertDatabaseCount('genres', 1);
    }

    public function test_a_new_tag_creates_an_unreviewed_genre(): void
    {
        $genre = (new GenreResolver)->resolve('Afro house');

        $this->assertSame('Afro house', $genre?->name);
        $this->assertSame('afro-house', $genre?->slug);
        $this->assertNull($genre?->sort);
        $this->assertSame(1, Genre::query()->unreviewed()->count());
    }

    public function test_an_alias_matches_the_existing_genre(): void
    {
        $genre = Genre::factory()->create(['name' => 'Deep Tech House', 'slug' => 'deep-tech-house', 'aliases' => ['deep tech']]);

        $this->assertTrue((new GenreResolver)->resolve('Deep Tech')?->is($genre));
        $this->assertDatabaseCount('genres', 1);
    }

    public function test_blank_tags_resolve_to_nothing(): void
    {
        $this->assertNull((new GenreResolver)->resolve('   '));
        $this->assertDatabaseCount('genres', 0);
    }

    public function test_resolve_many_returns_unique_genres_in_first_seen_order(): void
    {
        $genres = (new GenreResolver)->resolveMany(['House', 'Tech house', 'house', 'TechHouse', null, 'Techno']);

        $this->assertSame(['House', 'Tech house', 'Techno'], $genres->pluck('name')->all());
    }
}
