<?php

namespace Tests\Feature\Analytics;

use App\Services\Analytics\CachedAnalyticsProvider;
use App\Services\Analytics\Contracts\AnalyticsProvider;
use App\Services\Analytics\Data\Period;
use App\Services\Analytics\Exceptions\AnalyticsUnavailable;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class AnalyticsServiceProviderTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->forgetInstance(AnalyticsProvider::class);
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
}
