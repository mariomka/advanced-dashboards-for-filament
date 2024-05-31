<?php

namespace Mariomka\FilamentDashboards\Commands;

use Illuminate\Console\Command;

class FilamentDashboardsCommand extends Command
{
    public $signature = 'filament-dashboards';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
