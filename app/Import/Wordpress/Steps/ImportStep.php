<?php

namespace App\Import\Wordpress\Steps;

use App\Import\Wordpress\ImportContext;

interface ImportStep
{
    /**
     * Name used by --only and in the report.
     */
    public function name(): string;

    public function run(ImportContext $context): void;
}
