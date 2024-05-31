<?php

namespace Mariomka\FilamentDashboards\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mariomka\FilamentDashboards\FilamentDashboards
 */
class FilamentDashboards extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Mariomka\FilamentDashboards\FilamentDashboards::class;
    }
}
