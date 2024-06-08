<div class="adffi-table-question h-full">
    {{ \Filament\Support\Facades\FilamentView::renderHook(Mariomka\AdvancedDashboardsForFilament\View\QuestionRenderHook::TABLE_QUESTION_START, scopes: static::class) }}

    {{ $this->table }}

    {{ \Filament\Support\Facades\FilamentView::renderHook(Mariomka\AdvancedDashboardsForFilament\View\QuestionRenderHook::TABLE_QUESTION_END, scopes: static::class) }}
</div>
