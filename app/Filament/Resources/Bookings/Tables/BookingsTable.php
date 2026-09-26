<?php

namespace App\Filament\Resources\Bookings\Tables;

use App\Filament\Support\EnumColumn;
use Djfabrizia\Content\Enums\BookingStatus;
use Djfabrizia\Content\Models\Booking;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                EnumColumn::make('status'),
                TextColumn::make('name')->searchable()->weight('bold')->description(fn (Booking $record): string => $record->email),
                TextColumn::make('message')->limit(80)->wrap()->searchable(),
                TextColumn::make('created_at')->label('Received')->since()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')->options(BookingStatus::options()),
            ])
            ->recordActions([
                Action::make('reply')
                    ->icon(Heroicon::OutlinedEnvelope)
                    ->url(fn (Booking $record): string => 'mailto:'.$record->email.'?subject='.rawurlencode('Re: your booking request')),
                Action::make('archive')
                    ->icon(Heroicon::OutlinedArchiveBox)
                    ->hidden(fn (Booking $record): bool => $record->status === BookingStatus::Archived)
                    ->action(fn (Booking $record) => $record->update(['status' => BookingStatus::Archived])),
                EditAction::make()->label('Open')->icon(Heroicon::OutlinedEye),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    self::statusBulkAction(BookingStatus::Read, 'Mark as read', Heroicon::OutlinedEnvelopeOpen),
                    self::statusBulkAction(BookingStatus::Archived, 'Archive', Heroicon::OutlinedArchiveBox),
                    BulkAction::make('export')
                        ->label('Export CSV')
                        ->icon(Heroicon::OutlinedArrowDownTray)
                        ->action(fn (Collection $records): StreamedResponse => self::csv($records)),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    private static function statusBulkAction(BookingStatus $status, string $label, Heroicon $icon): BulkAction
    {
        return BulkAction::make($status->value)
            ->label($label)
            ->icon($icon)
            ->action(fn (Collection $records) => $records->each->update(['status' => $status]))
            ->deselectRecordsAfterCompletion();
    }

    /**
     * @param  Collection<int, Booking>  $records
     */
    private static function csv(Collection $records): StreamedResponse
    {
        return response()->streamDownload(function () use ($records): void {
            $out = fopen('php://output', 'w');

            if ($out === false) {
                return;
            }

            fputcsv($out, ['Received', 'Name', 'Email', 'Message', 'Status'], escape: '');

            foreach ($records as $booking) {
                fputcsv($out, [
                    $booking->created_at->toDateTimeString(),
                    $booking->name,
                    $booking->email,
                    $booking->message,
                    $booking->status->label(),
                ], escape: '');
            }

            fclose($out);
        }, 'bookings-'.now()->format('Y-m-d').'.csv', ['Content-Type' => 'text/csv']);
    }
}
