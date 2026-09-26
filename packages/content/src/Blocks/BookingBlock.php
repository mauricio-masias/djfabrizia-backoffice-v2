<?php

namespace Djfabrizia\Content\Blocks;

/**
 * Booking form copy plus the "book me" equipment modal.
 */
final class BookingBlock extends Block
{
    public function rules(): array
    {
        return [
            'title' => self::LINE,
            'left' => self::TEXT,
            'right' => self::TEXT,
            'success' => self::TEXT,
            'modal' => ['array'],
            'modal.pa' => self::TEXT,
            'modal.lights' => self::TEXT,
            'modal.booth' => self::TEXT,
            'modal.controller' => self::TEXT,
        ];
    }

    public function defaults(): array
    {
        return ['title' => null, 'left' => null, 'right' => null, 'success' => null, 'modal' => ['pa' => null, 'lights' => null, 'booth' => null, 'controller' => null]];
    }
}
