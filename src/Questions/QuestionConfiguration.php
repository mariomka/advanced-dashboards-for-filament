<?php

namespace Mariomka\AdvancedDashboardsForFilament\Questions;

class QuestionConfiguration
{
    /**
     * @param  int | string | array<string, int | string | null>  $cols
     * @param  int | string | array<string, int | string | null>  $rows
     */
    public function __construct(
        readonly public string $question,
        protected array $properties = [],
        protected int | string | array $cols = 3,
        protected int | string | array $rows = 3,
    ) {
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
