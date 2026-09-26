<?php

namespace Djfabrizia\Content\Concerns;

use Illuminate\Support\Str;

/**
 * Human labels for backed enums, without depending on Filament: the endpoint
 * shares these enums and must not pull in the admin stack.
 */
trait HasLabel
{
    public function label(): string
    {
        return Str::headline($this->name);
    }

    /**
     * @return array<string, string> value => label, for select inputs
     */
    public static function options(): array
    {
        $options = [];

        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}
