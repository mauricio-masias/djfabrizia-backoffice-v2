<?php

namespace App\Import\Wordpress\Steps;

use App\Import\Wordpress\ImportContext;
use Djfabrizia\Content\Enums\MenuTarget;
use Djfabrizia\Content\Legacy\WordpressPages;
use Djfabrizia\Content\Models\Menu;
use Djfabrizia\Content\Models\MenuItem;
use Illuminate\Support\Str;

/**
 * WordPress nav menus → the three menus. URLs are kept exactly as stored,
 * because v1 derives its url/hash/internal fields from them. Items titled
 * "icon-<name>" become icon items.
 */
class MenusStep implements ImportStep
{
    private const ICON_PREFIX = 'icon-';

    public function name(): string
    {
        return 'menus';
    }

    public function run(ImportContext $context): void
    {
        foreach (WordpressPages::MENUS as $termTaxonomyId => $slug) {
            $menu = Menu::query()->firstOrCreate(
                ['slug' => $slug],
                ['name' => Str::headline($slug).' menu', 'legacy_wp_id' => $termTaxonomyId],
            );

            $items = $context->source->menuItems($termTaxonomyId);
            $parents = [];

            foreach ($items as $post) {
                $meta = $context->source->meta($post->ID);
                $isIcon = str_starts_with($post->post_title, self::ICON_PREFIX);
                $icon = $isIcon ? substr($post->post_title, strlen(self::ICON_PREFIX)) : null;

                $item = MenuItem::query()->updateOrCreate(['legacy_wp_id' => $post->ID], [
                    'menu_id' => $menu->id,
                    'title' => $isIcon ? Str::headline((string) $icon) : $post->post_title,
                    'url' => (string) $meta->get('_menu_item_url'),
                    'target' => $meta->get('_menu_item_target') === MenuTarget::Blank->value ? MenuTarget::Blank : MenuTarget::Self,
                    'icon' => $icon,
                    'sort' => $post->menu_order,
                ]);

                $context->remember('menu_items', $post->ID, $item->id);
                $parents[$item->id] = $meta->int('_menu_item_menu_item_parent');
                $context->saved($this->name(), $item);
            }

            // Parents are set in a second pass, once every item of the menu exists.
            foreach ($parents as $itemId => $parentWordpressId) {
                $parentId = $parentWordpressId ? $context->idFor('menu_items', $parentWordpressId) : null;
                $item = MenuItem::query()->findOrFail($itemId);

                if ($item->parent_id !== $parentId) {
                    $item->update(['parent_id' => $parentId]);
                }
            }

            $menu->items()->whereNotNull('legacy_wp_id')->whereNotIn('legacy_wp_id', $items->pluck('ID'))->delete();
        }
    }
}
