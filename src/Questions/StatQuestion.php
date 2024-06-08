<?php

namespace Mariomka\AdvancedDashboardsForFilament\Questions;

use Filament\Widgets\StatsOverviewWidget\Stat;

abstract class StatQuestion extends Question
{
    protected ?Stat $cachedStat = null;

    /**
     * @var view-string
     */
    protected static string $view = 'advanced-dashboards-for-filament::questions.stat-question';

    protected function getCachedStat(): Stat
    {
        return $this->cachedStat ??= $this->getStat();
    }

    abstract protected function getStat(): Stat;
}
