<?php

namespace App\Providers;

use App\Services\Analytics\AnalyticsSite;
use App\Services\Analytics\CachedAnalyticsProvider;
use App\Services\Analytics\Contracts\AnalyticsProvider;
use App\Services\Analytics\Exceptions\AnalyticsUnavailable;
use App\Services\Analytics\FakeAnalyticsProvider;
use App\Services\Analytics\GoogleAnalyticsProvider;
use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Illuminate\Contracts\Cache\Factory as CacheFactory;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AnalyticsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        foreach (AnalyticsSite::cases() as $site) {
            $this->app->singleton($site->binding(), fn (): AnalyticsProvider => $this->cachedProvider($site));
        }
    }

    private function cachedProvider(AnalyticsSite $site): AnalyticsProvider
    {
        return new CachedAnalyticsProvider(
            inner: $this->baseProvider($site),
            cache: $this->app->make(CacheFactory::class)->store(config('analytics.cache.store')),
            prefix: $this->cachePrefix($site),
            liveTtl: (int) config('analytics.cache.live_ttl', 900),
            historicalTtl: (int) config('analytics.cache.historical_ttl', 43200),
        );
    }

    private function cachePrefix(AnalyticsSite $site): string
    {
        $prefix = config('analytics.cache.prefix', 'analytics');

        return match ($site) {
            AnalyticsSite::Main => $prefix,
            AnalyticsSite::FabriziaCorsi => "{$prefix}:fabrizia_corsi",
        };
    }

    private function baseProvider(AnalyticsSite $site): AnalyticsProvider
    {
        if (config('analytics.driver') === 'fake') {
            return new FakeAnalyticsProvider;
        }

        $propertyId = $this->propertyId($site);
        $credentials = $this->credentialsPath($site);

        // Checked before the catch below, which cannot tell a missing class
        // from a bad key and would otherwise blame the credentials for a
        // dependency that was never installed.
        if (! class_exists(BetaAnalyticsDataClient::class)) {
            throw AnalyticsUnavailable::notConfigured(
                'the google/analytics-data package is not installed. Run "composer install" in this environment.'
            );
        }

        try {
            $client = new BetaAnalyticsDataClient(['credentials' => $credentials]);
        } catch (Throwable $e) {
            // A malformed or wrong-type key file fails inside the Google
            // client with its own exception types. Left unconverted, those
            // escape the widgets' catch and take down the whole admin panel,
            // whose landing page is the dashboard. The wording stays neutral
            // about the cause, because this catch sees more than bad keys.
            throw AnalyticsUnavailable::notConfigured(
                "the Google Analytics client could not be created using the key at {$this->describeKey($site, $credentials)}: {$e->getMessage()}"
            );
        }

        return new GoogleAnalyticsProvider(
            client: $client,
            propertyId: $propertyId,
        );
    }

    /**
     * The numeric GA4 property id. A measurement id ("G-XXXXXXX") is a common
     * mix-up and produces an opaque permission error from the API, so it is
     * rejected here with a message that says what to do about it.
     */
    private function propertyId(AnalyticsSite $site): string
    {
        $propertyId = (string) $this->setting($site, 'property_id');
        $variable = match ($site) {
            AnalyticsSite::Main => 'GA4_PROPERTY_ID',
            AnalyticsSite::FabriziaCorsi => 'GA4_SISTER_PROPERTY_ID',
        };

        if ($propertyId === '') {
            throw AnalyticsUnavailable::notConfigured("{$variable} is not set.");
        }

        if (! ctype_digit($propertyId)) {
            throw AnalyticsUnavailable::notConfigured(
                "{$variable} must be the numeric property id from GA4 Admin -> Property Settings, got \"{$propertyId}\"."
            );
        }

        if ($site === AnalyticsSite::FabriziaCorsi) {
            $this->rejectMainProperty($propertyId);
        }

        return $propertyId;
    }

    /**
     * Reusing the main site's id would silently report the main site's
     * numbers as the sister site's.
     */
    private function rejectMainProperty(string $propertyId): void
    {
        if ($propertyId === (string) $this->setting(AnalyticsSite::Main, 'property_id')) {
            throw AnalyticsUnavailable::notConfigured(
                'GA4_SISTER_PROPERTY_ID is the same property as GA4_PROPERTY_ID. Set it to the numeric property id of the FabriziaCorsi site.'
            );
        }
    }

    private function credentialsPath(AnalyticsSite $site): string
    {
        $configured = (string) $this->setting($site, 'credentials_path');

        if ($configured === '') {
            throw AnalyticsUnavailable::notConfigured("{$this->credentialsVariable($site)} is not set.");
        }

        $path = str_starts_with($configured, '/') ? $configured : base_path($configured);

        if (! is_readable($path)) {
            throw AnalyticsUnavailable::notConfigured(
                "the service account key at {$this->describeKey($site, $path)} is missing or unreadable."
            );
        }

        return $path;
    }

    private function credentialsVariable(AnalyticsSite $site): string
    {
        return match ($site) {
            AnalyticsSite::Main => 'GA4_CREDENTIALS_PATH',
            AnalyticsSite::FabriziaCorsi => 'GA4_SISTER_CREDENTIALS_PATH',
        };
    }

    private function describeKey(AnalyticsSite $site, string $path): string
    {
        return match ($site) {
            AnalyticsSite::Main => $path,
            AnalyticsSite::FabriziaCorsi => "{$path} ({$this->credentialsVariable($site)})",
        };
    }

    private function setting(AnalyticsSite $site, string $key): mixed
    {
        return match ($site) {
            AnalyticsSite::Main => config("analytics.{$key}"),
            AnalyticsSite::FabriziaCorsi => config("analytics.fabrizia_corsi.{$key}"),
        };
    }
}
