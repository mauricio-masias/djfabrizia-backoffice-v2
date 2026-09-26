<?php

namespace Djfabrizia\Content\Tests\Models;

use Djfabrizia\Content\Models\Page;
use Tests\TestCase;

class ContentConnectionTest extends TestCase
{
    public function test_models_use_the_default_connection_when_none_is_configured(): void
    {
        config(['content.connection' => null]);

        $this->assertNull((new Page)->getConnectionName());
    }

    public function test_models_use_the_configured_content_connection(): void
    {
        config(['content.connection' => 'cms']);

        $this->assertSame('cms', (new Page)->getConnectionName());
    }
}
