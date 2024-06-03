<?php

namespace Mariomka\AdvancedDashboardsForFilament\Tests\Pages;

use Mariomka\AdvancedDashboardsForFilament\Dashboard\AdvancedDashboard;
use Mariomka\AdvancedDashboardsForFilament\Questions\QuestionConfiguration;
use Mariomka\AdvancedDashboardsForFilament\Tests\Questions\TestChartQuestion;

class TestDashboard extends AdvancedDashboard
{
    protected static ?string $title = 'Test Dashboard';

    public function getQuestions(): array
    {
        return [
            new QuestionConfiguration(TestChartQuestion::class, cols: 6, rows: 4),
        ];
    }
}
