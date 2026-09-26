<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Bookings\BookingResource;
use App\Filament\Resources\Genres\GenreResource;
use Djfabrizia\Content\Enums\BookingStatus;
use Djfabrizia\Content\Models\Booking;
use Djfabrizia\Content\Models\Genre;
use Djfabrizia\Content\Models\Mix;
use Djfabrizia\Content\Models\Release;
use Djfabrizia\Content\Models\Video;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContentStats extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $unread = Booking::query()->where('status', BookingStatus::Unread->value)->count();
        $unreviewed = Genre::query()->unreviewed()->count();

        return [
            Stat::make('Unread bookings', $unread)
                ->icon(Heroicon::OutlinedInboxArrowDown)
                ->color($unread > 0 ? 'warning' : 'gray')
                ->url(BookingResource::getUrl('index')),
            Stat::make('Published mixes', Mix::query()->published()->count())->icon(Heroicon::OutlinedMusicalNote),
            Stat::make('Published releases', Release::query()->published()->count())->icon(Heroicon::OutlinedCircleStack),
            Stat::make('Published videos', Video::query()->published()->count())->icon(Heroicon::OutlinedFilm),
            Stat::make('Genres to review', $unreviewed)
                ->description('Created automatically from tags')
                ->icon(Heroicon::OutlinedTag)
                ->color($unreviewed > 0 ? 'warning' : 'gray')
                ->url(GenreResource::getUrl('index')),
        ];
    }
}
