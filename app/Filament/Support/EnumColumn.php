<?php

namespace App\Filament\Support;

use BackedEnum;
use Filament\Tables\Columns\TextColumn;

/**
 * Badge column for the package's backed enums, which expose label() and an
 * optional color() without implementing Filament's interfaces.
 */
final class EnumColumn
{
    public static function make(string $name): TextColumn
    {
        return TextColumn::make($name)
            ->badge()
            ->formatStateUsing(static fn (mixed $state): string => $state instanceof BackedEnum && method_exists($state, 'label')
                ? $state->label()
                : (string) $state)
            ->color(static fn (mixed $state): ?string => $state instanceof BackedEnum && method_exists($state, 'color')
                ? $state->color()
                : 'gray');
    }
}
