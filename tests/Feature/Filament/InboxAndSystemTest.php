<?php

namespace Tests\Feature\Filament;

use App\Filament\Pages\Settings;
use App\Filament\Resources\Bookings\BookingResource;
use App\Filament\Resources\Bookings\Pages\EditBooking;
use App\Filament\Resources\Bookings\Pages\ListBookings;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Widgets\ContentStats;
use App\Filament\Widgets\LatestBookings;
use App\Models\User;
use App\Settings\SiteSettings;
use Djfabrizia\Content\Enums\BookingStatus;
use Djfabrizia\Content\Models\Booking;
use Livewire\Livewire;

class InboxAndSystemTest extends AdminTestCase
{
    public function test_opening_an_unread_booking_marks_it_as_read(): void
    {
        $booking = Booking::factory()->create();

        Livewire::test(EditBooking::class, ['record' => $booking->getRouteKey()])
            ->assertFormSet(['status' => BookingStatus::Read->value]);

        $this->assertSame(BookingStatus::Read, $booking->fresh()?->status);
    }

    public function test_bookings_cannot_be_created_from_the_back_office(): void
    {
        $this->assertFalse(BookingResource::hasPage('create'));
    }

    public function test_the_navigation_badge_counts_unread_bookings(): void
    {
        Booking::factory()->count(2)->create();
        Booking::factory()->read()->create();

        $this->assertSame('2', BookingResource::getNavigationBadge());
    }

    public function test_bookings_can_be_archived_and_exported(): void
    {
        $bookings = Booking::factory()->count(2)->create();

        Livewire::test(ListBookings::class)
            ->callTableAction('archive', $bookings[0])
            ->callTableBulkAction('export', $bookings)
            ->assertFileDownloaded('bookings-'.now()->format('Y-m-d').'.csv');

        $this->assertSame(BookingStatus::Archived, $bookings[0]->fresh()?->status);
    }

    public function test_an_admin_can_create_another_admin(): void
    {
        Livewire::test(CreateUser::class)
            ->fillForm(['name' => 'Editor', 'email' => 'editor@example.com', 'password' => 'a-very-long-password', 'is_admin' => true])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertTrue(User::query()->where('email', 'editor@example.com')->firstOrFail()->is_admin);
    }

    public function test_an_admin_cannot_remove_their_own_access_or_delete_themselves(): void
    {
        Livewire::test(EditUser::class, ['record' => $this->admin->getRouteKey()])
            ->assertFormFieldDisabled('is_admin')
            ->assertActionHidden('delete')
            ->fillForm(['name' => 'Renamed', 'is_admin' => false])
            ->call('save');

        $this->assertTrue($this->admin->fresh()?->is_admin);
        $this->assertSame('Renamed', $this->admin->fresh()?->name);
    }

    public function test_settings_are_saved(): void
    {
        Livewire::test(Settings::class)
            ->fillForm(['sync' => ['mixcloud_user' => 'djfabrizia', 'spotify_user_id' => '11162006882', 'youtube_channel_id' => 'UC123'], 'bookings' => ['notify_email' => 'bookings@example.com']])
            ->call('save')
            ->assertNotified();

        $this->assertSame('djfabrizia', SiteSettings::get('sync', 'mixcloud_user'));
        $this->assertSame('bookings@example.com', SiteSettings::get('bookings', 'notify_email'));
    }

    public function test_settings_reject_an_invalid_email(): void
    {
        Livewire::test(Settings::class)
            ->fillForm(['bookings' => ['notify_email' => 'nope']])
            ->call('save')
            ->assertHasFormErrors(['bookings.notify_email']);
    }

    public function test_the_dashboard_and_its_widgets_render(): void
    {
        $booking = Booking::factory()->create(['name' => 'Maria Rossi']);

        $this->get('/admin')->assertOk();
        Livewire::test(ContentStats::class)->assertSee('Unread bookings')->assertSee('Genres to review');
        Livewire::test(LatestBookings::class)->assertCanSeeTableRecords([$booking]);
    }
}
