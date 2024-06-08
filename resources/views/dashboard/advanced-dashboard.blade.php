@if($loadCss)
<div
    x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('advanced-dashboards-for-filament-styles', package: 'mariomka/advanced-dashboards-for-filament'))]"
>
@endif
    <div
        @if ($pollingInterval = $this->getPollingInterval())
            wire:poll.{{ $pollingInterval }}="$refresh"
        @endif
    >
        <x-filament-panels::page class="adffi-advanced-dashboard-page">
            @if ($this->showFiltersForm())
                <form wire:submit="$refresh">
                    {{ $this->filtersForm }}
                </form>
            @endif

            <x-advanced-dashboards-for-filament::questions-grid
                :columns="$this->getColumns()"
                :rowHeight="$this->getRowHeight()"
                :data="
                    [
                        ...(property_exists($this, 'filters') ? ['filters' => $this->filters] : []),
                        ...$this->getWidgetData(),
                    ]
                "
                :questions="$this->getQuestions()"
            />
        </x-filament-panels::page>
    </div>
@if($loadCss)
</div>
@endif

