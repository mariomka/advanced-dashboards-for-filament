<div class="adffi-array-table-question h-full">
    {{ \Filament\Support\Facades\FilamentView::renderHook(Mariomka\AdvancedDashboardsForFilament\View\QuestionRenderHook::ARRAY_TABLE_QUESTION_START, scopes: static::class) }}

    <x-advanced-dashboards-for-filament::array-table
        :key-prefix="$this->getId()"
        :heading="$this->getHeading()"
        :description="$this->getDescription()"
        :records="$this->getCachedRecords()"
        :columns="$this->getColumns()"
        :isStriped="$this->isStriped()"
        :getColumnState="$this->getColumnState(...)"
        :hasEmptyState="$this"
    />

    {{ \Filament\Support\Facades\FilamentView::renderHook(Mariomka\AdvancedDashboardsForFilament\View\QuestionRenderHook::ARRAY_TABLE_QUESTION_END, scopes: static::class) }}
</div>
