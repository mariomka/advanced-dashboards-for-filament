<div
    x-ref="advancedDashboard"
    class="adffi-advanced-dashboard-page"
    :class="isFullscreen ? 'w-full h-full overflow-y-auto bg-gray-50 dark:bg-gray-950' : ''"
    x-data="{ isFullscreen: false }"
    @fullscreenchange.window="isFullscreen = (document.fullscreenElement === $refs.advancedDashboard)"
    @if($loadCss)
        x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('advanced-dashboards-for-filament-styles', package: 'mariomka/advanced-dashboards-for-filament'))]"
    @endif
    @if ($pollingInterval = $this->getPollingInterval())
        wire:poll.{{ $pollingInterval }}="$refresh"
    @endif
>
    <div :class="isFullscreen ? 'w-full m-auto max-w-[1920px] px-4 md:px-6 lg:px-8' : ''">
        <x-filament-panels::page>
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
</div>
