<?php

namespace Tests\Feature\Filament;

use Tests\TestCase;

class LoginBackdropTest extends TestCase
{
    public function test_the_login_page_renders_the_decorative_backdrop(): void
    {
        $this->get('/admin/login')
            ->assertOk()
            ->assertSee('<div class="login-backdrop" aria-hidden="true">', false)
            ->assertSee('login-backdrop__glow-line', false);
    }
}
