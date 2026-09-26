<?php

namespace Djfabrizia\Content\Taxonomy;

use Djfabrizia\Content\Models\Genre;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Maps free-text genre tags (Mixcloud tags, the style part of a WordPress
 * release description) to shared Genre rows.
 *
 * A tag matches a genre by slug, by slug without hyphens ("tech-house" and
 * "techhouse"), or by one of the genre's aliases. A tag that matches nothing
 * creates a genre with a null sort position, which marks it as unreviewed.
 *
 * The genre table is small, so it is indexed in memory once per instance;
 * reuse one instance for a whole import or sync run.
 */
class GenreResolver
{
    /** @var array<string, Genre>|null */
    private ?array $index = null;

    public function resolve(string $tag): ?Genre
    {
        $name = trim(preg_replace('/\s+/u', ' ', $tag) ?? '');

        if ($name === '') {
            return null;
        }

        $index = $this->index();

        foreach (self::keys($name) as $key) {
            if (isset($index[$key])) {
                return $index[$key];
            }
        }

        $genre = Genre::query()->create([
            'name' => $name,
            'slug' => Str::slug($name),
            'aliases' => [],
            'sort' => null,
        ]);

        $this->remember($genre);

        return $genre;
    }

    /**
     * @param  iterable<mixed>  $tags
     * @return Collection<int, Genre> unique genres, in first-seen order
     */
    public function resolveMany(iterable $tags): Collection
    {
        $genres = collect();

        foreach ($tags as $tag) {
            $genre = is_string($tag) ? $this->resolve($tag) : null;

            if ($genre !== null && ! $genres->has($genre->id)) {
                $genres->put($genre->id, $genre);
            }
        }

        return $genres->values();
    }

    /**
     * Normalized lookup keys for a name: its slug and its slug without hyphens.
     *
     * @return list<string>
     */
    public static function keys(string $name): array
    {
        $slug = Str::slug($name);

        if ($slug === '') {
            return [];
        }

        return array_values(array_unique([$slug, str_replace('-', '', $slug)]));
    }

    /**
     * @return array<string, Genre>
     */
    private function index(): array
    {
        if ($this->index === null) {
            $this->index = [];

            foreach (Genre::query()->orderBy('id')->get() as $genre) {
                $this->remember($genre);
            }
        }

        return $this->index ?? [];
    }

    private function remember(Genre $genre): void
    {
        $names = [$genre->slug, ...($genre->aliases ?? [])];

        foreach ($names as $name) {
            foreach (self::keys($name) as $key) {
                $this->index[$key] ??= $genre;
            }
        }
    }
}
