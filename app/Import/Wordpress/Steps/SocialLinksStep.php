<?php

namespace App\Import\Wordpress\Steps;

use App\Import\Wordpress\ImportContext;
use Djfabrizia\Content\Models\SocialLink;

/**
 * The Social page's `social_icons` repeater.
 */
class SocialLinksStep implements ImportStep
{
    private const SOCIAL_PAGE_ID = 967;

    public function name(): string
    {
        return 'social_links';
    }

    public function run(ImportContext $context): void
    {
        $rows = $context->source->meta(self::SOCIAL_PAGE_ID)
            ->repeater('social_icons', ['icon_network', 'icon_class', 'icon_type', 'icon_link', 'icon_app_link']);
        $keys = [];

        foreach ($rows as $sort => $row) {
            $keys[] = $key = self::SOCIAL_PAGE_ID.":social_icons:{$sort}";

            $link = SocialLink::query()->updateOrCreate(['legacy_key' => $key], [
                'network' => (string) $row['icon_network'],
                'icon_class' => $row['icon_class'],
                'type' => $row['icon_type'],
                'url' => (string) $row['icon_link'],
                'app_url' => $row['icon_app_link'] ?: null,
                'sort' => $sort,
            ]);

            $context->saved($this->name(), $link);
        }

        SocialLink::query()->whereNotNull('legacy_key')->whereNotIn('legacy_key', $keys)->delete();
    }
}
