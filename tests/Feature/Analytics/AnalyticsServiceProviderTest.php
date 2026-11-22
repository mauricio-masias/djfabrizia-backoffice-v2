<?php

namespace Tests\Feature\Analytics;

use App\Services\Analytics\AnalyticsSite;
use App\Services\Analytics\CachedAnalyticsProvider;
use App\Services\Analytics\Contracts\AnalyticsProvider;
use App\Services\Analytics\Data\Period;
use App\Services\Analytics\Exceptions\AnalyticsUnavailable;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AnalyticsServiceProviderTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        foreach (AnalyticsSite::cases() as $site) {
            $this->app->forgetInstance($site->binding());
        }
    }

    /**
     * Points the container at the real Google driver. Nothing here reaches
     * the network: every case fails while the client is being built.
     */
    private function useGoogleDriver(?string $propertyId, ?string $credentialsPath = null): void
    {
        config()->set('analytics.driver', 'google');
        config()->set('analytics.property_id', $propertyId);
        config()->set('analytics.credentials_path', $credentialsPath ?? storage_path('framework/testing/missing-ga-key.json'));
    }

    /**
     * Adds the sister site to the Google driver. Its own valid settings are
     * independent of the main site's, which each test sets with
     * useGoogleDriver().
     */
    private function useSisterProperty(?string $propertyId, ?string $credentialsPath = null): void
    {
        config()->set('analytics.fabrizia_corsi.property_id', $propertyId);
        config()->set('analytics.fabrizia_corsi.credentials_path', $credentialsPath ?? storage_path('framework/testing/missing-ga-sister-key.json'));
    }

    /**
     * A key the Google client accepts when it is built. The private key is
     * only read when a request is signed, which no test here does.
     */
    private function acceptedKeyFile(): string
    {
        return $this->keyFile('accepted-ga-key.json', [
            'type' => 'service_account',
            'project_id' => 'test-project',
            'client_email' => 'test@example.com',
            'private_key' => 'not-a-real-key',
        ]);
    }

    /**
     * @param  array<string, string>  $contents
     */
    private function keyFile(string $name, array $contents): string
    {
        $path = storage_path("framework/testing/{$name}");
        @mkdir(dirname($path), 0755, true);
        file_put_contents($path, json_encode($contents));
        $this->beforeApplicationDestroyed(fn () => @unlink($path));

        return $path;
    }

    public function test_the_fake_driver_resolves_behind_the_cache(): void
    {
        config()->set('analytics.driver', 'fake');
        config()->set('analytics.cache.store', 'array');

        $provider = $this->app->make(AnalyticsProvider::class);
        $period = Period::lastDays(7);

        $this->assertInstanceOf(CachedAnalyticsProvider::class, $provider);
        $this->assertGreaterThan(0, $provider->summary($period)->visitors);
        $this->assertIsArray(Cache::store('array')->get('analytics:summary:'.$period->cacheKey()));
    }

    public function test_a_missing_property_id_is_reported_as_unavailable(): void
    {
        $this->useGoogleDriver(null);

        $this->expectException(AnalyticsUnavailable::class);
        $this->expectExceptionMessage('GA4_PROPERTY_ID is not set.');

        $this->app->make(AnalyticsProvider::class);
    }

    public function test_a_measurement_id_is_rejected_with_a_helpful_message(): void
    {
        $this->useGoogleDriver('G-ABC123');

        $this->expectException(AnalyticsUnavailable::class);
        $this->expectExceptionMessage('must be the numeric property id');

        $this->app->make(AnalyticsProvider::class);
    }

    public function test_a_missing_key_file_is_reported_as_unavailable(): void
    {
        $this->useGoogleDriver('123456789');

        $this->expectException(AnalyticsUnavailable::class);
        $this->expectExceptionMessage('missing or unreadable');

        $this->app->make(AnalyticsProvider::class);
    }

    public function test_a_malformed_key_file_is_reported_as_unavailable(): void
    {
        // The Google client throws its own exception types for a wrong-type
        // key. Left unconverted they would escape the widgets' catch.
        $path = storage_path('framework/testing/broken-ga-key.json');
        @mkdir(dirname($path), 0755, true);
        file_put_contents($path, '{"type":"authorized_user"}');
        $this->useGoogleDriver('123456789', $path);

        try {
            $this->assertThrows(
                fn () => $this->app->make(AnalyticsProvider::class),
                AnalyticsUnavailable::class,
            );
        } finally {
            @unlink($path);
        }
    }

    public function test_the_sister_site_caches_under_its_own_prefix(): void
    {
        config()->set('analytics.driver', 'fake');
        config()->set('analytics.cache.store', 'array');
        $period = Period::lastDays(7);

        $provider = $this->app->make(AnalyticsSite::FabriziaCorsi->binding());

        $this->assertInstanceOf(CachedAnalyticsProvider::class, $provider);
        $this->assertGreaterThan(0, $provider->summary($period)->visitors);
        $this->assertIsArray(Cache::store('array')->get('analytics:fabrizia_corsi:summary:'.$period->cacheKey()));
        $this->assertNull(Cache::store('array')->get('analytics:summary:'.$period->cacheKey()));
    }

    public function test_each_site_resolves_to_its_own_singleton(): void
    {
        config()->set('analytics.driver', 'fake');

        $main = $this->app->make(AnalyticsSite::Main->binding());
        $sister = $this->app->make(AnalyticsSite::FabriziaCorsi->binding());

        $this->assertNotSame($main, $sister);
        $this->assertSame($main, $this->app->make(AnalyticsProvider::class));
        $this->assertSame($sister, $this->app->make(AnalyticsSite::FabriziaCorsi->binding()));
    }

    /**
     * @return array<string, array{?string, ?string, string}>
     */
    public static function brokenSisterSettings(): array
    {
        return [
            'missing property id' => [null, null, 'GA4_SISTER_PROPERTY_ID is not set.'],
            'measurement id' => ['G-ABC123', null, 'GA4_SISTER_PROPERTY_ID must be the numeric property id'],
            'empty credentials path' => ['987654321', '', 'GA4_SISTER_CREDENTIALS_PATH is not set.'],
            'missing key file' => ['987654321', null, 'missing-ga-sister-key.json (GA4_SISTER_CREDENTIALS_PATH) is missing or unreadable.'],
            'same property as the main site' => ['123456789', null, 'GA4_SISTER_PROPERTY_ID is the same property as GA4_PROPERTY_ID'],
        ];
    }

    #[DataProvider('brokenSisterSettings')]
    public function test_broken_sister_settings_are_reported_as_unavailable_and_leave_the_main_site_resolving(
        ?string $propertyId,
        ?string $credentialsPath,
        string $expectedMessage,
    ): void {
        $this->useGoogleDriver('123456789', $this->acceptedKeyFile());
        $this->useSisterProperty($propertyId, $credentialsPath);

        $this->assertThrows(
            fn () => $this->app->make(AnalyticsSite::FabriziaCorsi->binding()),
            AnalyticsUnavailable::class,
            $expectedMessage,
        );
        $this->assertInstanceOf(CachedAnalyticsProvider::class, $this->app->make(AnalyticsProvider::class));
    }

    public function test_a_malformed_sister_key_file_is_reported_as_unavailable(): void
    {
        $path = $this->keyFile('broken-ga-sister-key.json', ['type' => 'authorized_user']);
        $this->useGoogleDriver('123456789', $this->acceptedKeyFile());
        $this->useSisterProperty('987654321', $path);

        $this->assertThrows(
            fn () => $this->app->make(AnalyticsSite::FabriziaCorsi->binding()),
            AnalyticsUnavailable::class,
            "could not be created using the key at {$path} (GA4_SISTER_CREDENTIALS_PATH)",
        );
        $this->assertInstanceOf(CachedAnalyticsProvider::class, $this->app->make(AnalyticsProvider::class));
    }

    public function test_a_broken_main_site_leaves_the_sister_site_resolving(): void
    {
        $this->useGoogleDriver(null);
        $this->useSisterProperty('987654321', $this->acceptedKeyFile());

        $this->assertThrows(
            fn () => $this->app->make(AnalyticsProvider::class),
            AnalyticsUnavailable::class,
            'GA4_PROPERTY_ID is not set.',
        );
        $this->assertInstanceOf(CachedAnalyticsProvider::class, $this->app->make(AnalyticsSite::FabriziaCorsi->binding()));
    }

    public function test_two_unset_property_ids_are_not_reported_as_the_same_property(): void
    {
        $this->useGoogleDriver(null);
        $this->useSisterProperty(null);

        $this->assertThrows(
            fn () => $this->app->make(AnalyticsSite::FabriziaCorsi->binding()),
            AnalyticsUnavailable::class,
            'GA4_SISTER_PROPERTY_ID is not set.',
        );
    }
}
