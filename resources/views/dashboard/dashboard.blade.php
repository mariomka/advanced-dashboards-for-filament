<x-filament-panels::page class="fi-dashboard-page">
    @if ($this->getShowFilters())
        <form wire:submit="update">
            {{ $this->filtersForm }}
        </form>
    @endif

    <div wire:loading>
        <x-filament::loading-indicator class="h-5 w-5" />
    </div>

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
