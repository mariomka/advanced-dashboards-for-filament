<?php

namespace Mariomka\AdvancedDashboardsForFilament\Tests\Questions;

use Mariomka\AdvancedDashboardsForFilament\Questions\ChartQuestion;

class TestChartQuestion extends ChartQuestion
{
    protected function getType(): string
    {
        return 'line';
    }
}
