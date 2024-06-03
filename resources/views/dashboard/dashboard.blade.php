<x-filament-panels::page class="fi-dashboard-page">
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
