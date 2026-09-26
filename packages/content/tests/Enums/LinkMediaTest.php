<?php

namespace Djfabrizia\Content\Tests\Enums;

use Djfabrizia\Content\Enums\LinkMedia;
use PHPUnit\Framework\TestCase;

class LinkMediaTest extends TestCase
{
    public function test_custom_handle_variants_know_their_platform(): void
    {
        $this->assertTrue(LinkMedia::SpotifyCustom->isCustomHandle());
        $this->assertSame('spotify', LinkMedia::SpotifyCustom->platform());
        $this->assertFalse(LinkMedia::Instagram->isCustomHandle());
        $this->assertSame('instagram', LinkMedia::Instagram->platform());
    }

    public function test_a_free_url_has_no_platform(): void
    {
        $this->assertNull(LinkMedia::Custom->platform());
        $this->assertFalse(LinkMedia::Custom->isCustomHandle());
    }

    public function test_values_match_the_wordpress_select(): void
    {
        foreach (['instagram', 'custom', 'mixcloud', 'youtube', 'facebook', 'spotify', 'instagram-custom', 'spotify-custom'] as $value) {
            $this->assertNotNull(LinkMedia::tryFrom($value), $value);
        }
    }
}
