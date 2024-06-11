<?php

namespace Mariomka\AdvancedDashboardsForFilament\Questions;

use Filament\Support\Concerns\EvaluatesClosures;
use Filament\Tables\Columns\Column;
use Filament\Tables\Table\Concerns\CanBeStriped;
use Filament\Tables\Table\Concerns\HasEmptyState;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use stdClass;

abstract class ArrayTableQuestion extends Question
{
    use CanBeStriped;
    use EvaluatesClosures;
    use HasEmptyState;

    /**
     * @var array<int, array<string, mixed>>
     */
    private array $cachedRecords;

    /**
     * @var view-string
     */
    protected static string $view = 'advanced-dashboards-for-filament::questions.array-table-question';

    /**
     * @return array<string, Column>
     */
    abstract public function getColumns(): array;

    /**
     * @return array<int, array<string, mixed>>
     */
    abstract protected function getRecords(): array;

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getCachedRecords(): array
    {
        return $this->cachedRecords ??= $this->getRecords();
    }

    public function getColumnState(Column $column, stdClass $rowLoop)
    {
        return $this->getCachedRecords()[$rowLoop->index][$column->getName()];
    }

    public function getEmptyStateHeading(): string | Htmlable
    {
        return $this->evaluate($this->emptyStateHeading) ?? __('advanced-dashboards-for-filament::default.array_table.empty.heading');
    }
}
