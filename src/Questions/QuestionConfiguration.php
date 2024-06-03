<?php

namespace Mariomka\AdvancedDashboardsForFilament\Questions;

class QuestionConfiguration
{
    /**
     * @param  int | string | array<string, int | string | null> | null  $cols
     * @param  int | string | array<string, int | string | null> | null  $rows
     */
    public function __construct(
        readonly public string $question,
        protected array $properties = [],
        protected int | string | array | null $cols = null,
        protected int | string | array | null $rows = null,
    ) {
        $this->cols ??= config('advanced-dashboards-for-filament.questions.cols');
        $this->rows ??= config('advanced-dashboards-for-filament.questions.rows');
    }

    /**
     * @return int | string | array<string, int | string | null>
     */
    public function getCols(): int | string | array
    {
        return $this->cols;
    }

    /**
     * @return int | string | array<string, int | string | null>
     */
    public function getRows(): int | string | array
    {
        return $this->rows;
    }

    public function getProperties(): array
    {
        return $this->properties;
    }
}
