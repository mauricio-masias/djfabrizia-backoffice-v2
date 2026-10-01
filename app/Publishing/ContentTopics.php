<?php

namespace App\Publishing;

use Djfabrizia\Content\Models\City;
use Djfabrizia\Content\Models\Club;
use Djfabrizia\Content\Models\Country;
use Djfabrizia\Content\Models\Genre;
use Djfabrizia\Content\Models\Link;
use Djfabrizia\Content\Models\LinkSection;
use Djfabrizia\Content\Models\Media;
use Djfabrizia\Content\Models\Menu;
use Djfabrizia\Content\Models\MenuItem;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Page;
use Djfabrizia\Content\Models\Playlist;
use Djfabrizia\Content\Models\RecordLabel;
use Djfabrizia\Content\Models\Release;
use Djfabrizia\Content\Models\ReleaseLink;
use Djfabrizia\Content\Models\SocialLink;
use Djfabrizia\Content\Models\UkVenue;
use Djfabrizia\Content\Models\Video;
use Illuminate\Database\Eloquent\Model;

/**
 * Which endpoint cache topics a changed row affects. The endpoint maps each
 * topic to its own v1/v2 cache keys (including pages that embed the content).
 */
final class ContentTopics
{
    /** Models whose changes are published to the endpoint. */
    public const OBSERVED = [
        Page::class, Mix::class, Release::class, ReleaseLink::class, Playlist::class, Video::class,
        Genre::class, RecordLabel::class, Media::class, Menu::class, MenuItem::class, SocialLink::class,
        LinkSection::class, Link::class, Country::class, City::class, Club::class, UkVenue::class,
    ];

    /**
     * @return list<string>
     */
    public static function for(Model $model): array
    {
        return match (true) {
            $model instanceof Page => array_values(array_unique(array_filter([
                'pages:'.$model->slug,
                // A renamed page must also drop the payload under its old slug.
                is_string($model->getOriginal('slug')) ? 'pages:'.$model->getOriginal('slug') : null,
            ]))),
            $model instanceof Mix => ['mixes'],
            $model instanceof Release, $model instanceof ReleaseLink, $model instanceof RecordLabel => ['releases'],
            $model instanceof Playlist => ['playlists'],
            $model instanceof Video => ['videos'],
            $model instanceof Genre => ['genres'],
            $model instanceof Media => ['media'],
            $model instanceof Menu => ['menus:'.$model->slug],
            $model instanceof MenuItem => self::menuTopics($model),
            $model instanceof SocialLink => ['social'],
            $model instanceof LinkSection, $model instanceof Link => ['linktree'],
            $model instanceof Country, $model instanceof City, $model instanceof Club, $model instanceof UkVenue => ['venues'],
            default => [],
        };
    }

    /**
     * @return list<string>
     */
    private static function menuTopics(MenuItem $item): array
    {
        $slug = Menu::query()->whereKey($item->menu_id)->value('slug');

        return is_string($slug) ? ['menus:'.$slug] : [];
    }
}
