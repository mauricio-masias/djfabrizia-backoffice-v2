<?php

namespace Tests\Unit;

use App\Sync\Duration;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class DurationTest extends TestCase
{
    /**
     * @return array<string, array{string|null, string|null}>
     */
    public static function iso(): array
    {
        return [
            'hours' => ['PT1H7M28S', '1:07:28'],
            'hours only' => ['PT2H', '2:00:00'],
            'minutes' => ['PT4M5S', '04:05'],
            'seconds' => ['PT38S', '00:38'],
            'days' => ['P1DT2H', '26:00:00'],
            'invalid' => ['10 minutes', null],
            'null' => [null, null],
        ];
    }

    #[DataProvider('iso')]
    public function test_youtube_durations_use_the_site_format(?string $iso, ?string $expected): void
    {
        $this->assertSame($expected, Duration::fromIso8601($iso));
    }

    public function test_mixcloud_seconds_keep_the_unpadded_wordpress_format(): void
    {
        $this->assertSame('63:6', Duration::fromSeconds(3786));
        $this->assertSame('60:10', Duration::fromSeconds(3610));
        $this->assertNull(Duration::fromSeconds(null));
    }
}
