<?php

namespace App\Console\Commands;

use App\Publishing\EndpointWarmer;
use Illuminate\Console\Command;

class WarmEndpoint extends Command
{
    protected $signature = 'endpoint:warm {--all : Rebuild every payload, not only pending changes}';

    protected $description = 'Send pending content changes to the endpoint cache (runs every minute)';

    public function handle(EndpointWarmer $warmer): int
    {
        $event = $warmer->flush($this->option('all') ? ['all'] : []);

        if ($event === null) {
            $this->line('Nothing pending.');

            return self::SUCCESS;
        }

        $this->line($event->status->label().': '.implode(', ', $event->targets));

        return self::SUCCESS;
    }
}
