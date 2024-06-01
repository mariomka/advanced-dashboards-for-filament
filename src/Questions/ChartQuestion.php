<?php

namespace Mariomka\AdvancedDashboardsForFilament\Questions;

use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Contracts\View\View;

abstract class ChartQuestion extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static string $view = 'advanced-dashboards-for-filament::questions.chart-question';

    protected static ?string $pollingInterval = null;

    protected function getOptions(): array|RawJs|null
    {
        return RawJs::make(<<<JS
        {
            maintainAspectRatio: false,
        }
    JS
        );
    }

    public function placeholder(): View
    {
        return view(
            'advanced-dashboards-for-filament::questions.loading-question',
        );
    }
}
