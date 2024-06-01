<?php

namespace Mariomka\AdvancedDashboardsForFilament\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mariomka\AdvancedDashboardsForFilament\AdvancedDashboardsForFilament
 */
class AdvancedDashboardsForFilament extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Mariomka\AdvancedDashboardsForFilament\AdvancedDashboardsForFilament::class;
    }
}
