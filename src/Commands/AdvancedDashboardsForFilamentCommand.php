<?php

namespace Mariomka\AdvancedDashboardsForFilament\Commands;

use Illuminate\Console\Command;

class AdvancedDashboardsForFilamentCommand extends Command
{
    public $signature = 'advanced-dashboards-for-filament';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
