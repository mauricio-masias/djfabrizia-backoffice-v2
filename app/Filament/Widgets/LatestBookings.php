<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Bookings\BookingResource;
use App\Filament\Support\EnumColumn;
use Djfabrizia\Content\Models\Booking;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LatestBookings extends TableWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Latest booking requests')
            ->query(Booking::query()->latest()->limit(5))
            ->paginated(false)
            ->columns([
                EnumColumn::make('status'),
                TextColumn::make('name')->description(fn (Booking $record): string => $record->email),
                TextColumn::make('message')->limit(60),
                TextColumn::make('created_at')->label('Received')->since(),
            ])
            ->recordActions([
                Action::make('open')->url(fn (Booking $record): string => BookingResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
