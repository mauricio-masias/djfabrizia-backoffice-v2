<?php

namespace App\Import\Wordpress;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Read-only access to the WordPress v1 database (the `wordpress` connection,
 * table prefix `dj_`). All postmeta is loaded once: the site is small.
 */
class WordpressSource
{
    /** @var array<int, list<array{key: string, value: string}>>|null */
    private ?array $meta = null;

    public function connection(): ConnectionInterface
    {
        return DB::connection('wordpress');
    }

    /**
     * @return Collection<int, object{ID: int, post_title: string, post_status: string, post_date: string, post_content: string, post_mime_type: string, menu_order: int}>
     */
    public function posts(string $type): Collection
    {
        /** @var Collection<int, object{ID: int, post_title: string, post_status: string, post_date: string, post_content: string, post_mime_type: string, menu_order: int}> $posts */
        $posts = $this->connection()->table('posts')
            ->select(['ID', 'post_title', 'post_status', 'post_date', 'post_content', 'post_mime_type', 'menu_order'])
            ->where('post_type', $type)
            ->whereIn('post_status', ['publish', 'draft', 'private', 'inherit', 'future'])
            ->orderBy('ID')
            ->get();

        return $posts;
    }

    /**
     * @return object{ID: int, post_title: string, post_status: string, post_date: string, post_content: string, post_mime_type: string, menu_order: int}|null
     */
    public function post(int $id): ?object
    {
        /** @var object{ID: int, post_title: string, post_status: string, post_date: string, post_content: string, post_mime_type: string, menu_order: int}|null $post */
        $post = $this->connection()->table('posts')
            ->select(['ID', 'post_title', 'post_status', 'post_date', 'post_content', 'post_mime_type', 'menu_order'])
            ->where('ID', $id)
            ->first();

        return $post;
    }

    public function meta(int $postId): Meta
    {
        if ($this->meta === null) {
            $this->meta = [];

            foreach ($this->connection()->table('postmeta')->select(['post_id', 'meta_key', 'meta_value'])->orderBy('meta_id')->cursor() as $row) {
                $this->meta[(int) $row->post_id][] = ['key' => (string) $row->meta_key, 'value' => (string) $row->meta_value];
            }
        }

        return new Meta($this->meta[$postId] ?? []);
    }

    /**
     * Menu item posts of one nav menu (term_taxonomy_id), in menu order.
     *
     * @return Collection<int, object{ID: int, post_title: string, menu_order: int}>
     */
    public function menuItems(int $termTaxonomyId): Collection
    {
        /** @var Collection<int, object{ID: int, post_title: string, menu_order: int}> $items */
        $items = $this->connection()->table('posts as p')
            ->join('term_relationships as tr', 'p.ID', '=', 'tr.object_id')
            ->select(['p.ID', 'p.post_title', 'p.menu_order'])
            ->where('p.post_type', 'nav_menu_item')
            ->where('tr.term_taxonomy_id', $termTaxonomyId)
            ->orderBy('p.menu_order')
            ->get();

        return $items;
    }

    /**
     * Contact Form 7 submissions (CFDB7) of one form.
     *
     * @return Collection<int, object{form_id: int, form_value: string, form_date: string}>
     */
    public function formSubmissions(int $formPostId): Collection
    {
        /** @var Collection<int, object{form_id: int, form_value: string, form_date: string}> $rows */
        $rows = $this->connection()->table('db7_forms')
            ->select(['form_id', 'form_value', 'form_date'])
            ->where('form_post_id', $formPostId)
            ->orderBy('form_id')
            ->get();

        return $rows;
    }
}
