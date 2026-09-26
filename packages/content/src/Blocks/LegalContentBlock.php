<?php

namespace Djfabrizia\Content\Blocks;

/**
 * Rich legal text such as the privacy policy.
 */
final class LegalContentBlock extends Block
{
    public function rules(): array
    {
        return [
            'html' => self::TEXT,
        ];
    }

    public function defaults(): array
    {
        return ['html' => ''];
    }
}
