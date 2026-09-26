<?php

namespace Djfabrizia\Content\Enums;

use Djfabrizia\Content\Concerns\HasLabel;

enum PageLocale: string
{
    use HasLabel;

    case English = 'en';
    case Italian = 'it';
}
