<?php

namespace App\Import\Wordpress;

use Djfabrizia\Content\Enums\PublishStatus;
use Illuminate\Support\Carbon;

/**
 * WordPress post status/date → status + published_at.
 */
final class Publishing
{
    /**
     * @param  object{post_status: string, post_date: string}  $post
     * @return array{status: PublishStatus, published_at: Carbon|null}
     */
    public static function of(object $post): array
    {
        $published = $post->post_status === 'publish';

        return [
            'status' => $published ? PublishStatus::Published : PublishStatus::Draft,
            'published_at' => $published && $post->post_date !== '0000-00-00 00:00:00' ? Carbon::parse($post->post_date) : null,
        ];
    }
}
