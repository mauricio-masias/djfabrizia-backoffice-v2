<?php

namespace App\Import\Wordpress\Steps;

use App\Import\Wordpress\ImportContext;
use App\Import\Wordpress\Meta;
use Djfabrizia\Content\Enums\LinkMedia;
use Djfabrizia\Content\Models\Link;
use Djfabrizia\Content\Models\LinkSection;

/**
 * The Linktree page's section and link repeaters. Links point at sections by
 * WordPress taxonomy term ID; those become real link ↔ section rows.
 */
class LinktreeStep implements ImportStep
{
    private const LINKTREE_PAGE_ID = 1347;

    public function name(): string
    {
        return 'linktree';
    }

    public function run(ImportContext $context): void
    {
        $meta = $context->source->meta(self::LINKTREE_PAGE_ID);
        $sectionIdsByTerm = $this->importSections($context, $meta);
        $keys = [];

        foreach ($meta->repeater('linkt_linktree', ['link_media', 'link_description', 'link_image', 'link_url', 'link_section']) as $sort => $row) {
            $media = LinkMedia::tryFrom(strtolower((string) $row['link_media']));

            if ($media === null) {
                $context->skipped($this->name(), "link {$sort} has an unknown type ({$row['link_media']})");

                continue;
            }

            $keys[] = $key = self::LINKTREE_PAGE_ID.":link:{$sort}";

            $link = Link::query()->updateOrCreate(['legacy_key' => $key], [
                'media' => $media,
                'description' => $row['link_description'],
                'image_media_id' => $context->idFor('media', $row['link_image']),
                'url' => $row['link_url'] ?: null,
                'sort' => $sort,
            ]);

            $sectionIds = array_values(array_filter(array_map(
                fn (string $termId): ?int => $sectionIdsByTerm[(int) $termId] ?? null,
                Meta::unserializeList($row['link_section']),
            )));

            $link->sections()->sync($sectionIds);
            $context->saved($this->name(), $link);
        }

        Link::query()->whereNotNull('legacy_key')->whereNotIn('legacy_key', $keys)->delete();
    }

    /**
     * @return array<int, int> WordPress term ID => section ID
     */
    private function importSections(ImportContext $context, Meta $meta): array
    {
        $map = [];
        $keys = [];

        foreach ($meta->repeater('linkt_sections', ['section_label', 'section_id']) as $sort => $row) {
            $keys[] = $key = self::LINKTREE_PAGE_ID.":section:{$sort}";

            $section = LinkSection::query()->updateOrCreate(['legacy_key' => $key], [
                'label' => (string) $row['section_label'],
                'sort' => $sort,
            ]);

            $map[(int) $row['section_id']] = $section->id;
            $context->saved($this->name(), $section);
        }

        LinkSection::query()->whereNotNull('legacy_key')->whereNotIn('legacy_key', $keys)->delete();

        return $map;
    }
}
