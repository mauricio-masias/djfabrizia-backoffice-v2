<?php

namespace Tests\Feature;

use Tests\TestCase;

class RootRedirectTest extends TestCase
{
    public function test_the_root_redirects_to_the_public_website(): void
    {
        $this->get('/')->assertRedirect('https://djfabrizia.com');
    }

    public function test_the_redirect_target_comes_from_config(): void
    {
        config(['cms.public_site_url' => 'https://example.test']);

        $this->get('/')->assertRedirect('https://example.test');
    }

    public function test_the_default_laravel_page_is_gone(): void
    {
        $this->assertFalse(view()->exists('welcome'));
    }
}
