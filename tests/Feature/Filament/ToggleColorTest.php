<?php

namespace Tests\Feature\Filament;

use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ToggleColumn;
use Tests\TestCase;

class ToggleColorTest extends TestCase
{
    public function test_toggles_use_success_color_when_on(): void
    {
        $toggle = Toggle::make('x');

        $this->assertSame('success', $toggle->getOnColor());
        $this->assertNull($toggle->getOffColor());
    }

    public function test_toggle_columns_use_success_color_when_on(): void
    {
        $this->assertSame('success', ToggleColumn::make('x')->getOnColor());
    }

    public function test_explicit_on_color_overrides_the_default(): void
    {
        $this->assertSame('danger', Toggle::make('x')->onColor('danger')->getOnColor());
    }
}
