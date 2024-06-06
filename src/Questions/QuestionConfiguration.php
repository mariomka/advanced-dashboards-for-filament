<?php

namespace Mariomka\AdvancedDashboardsForFilament\Questions;

class QuestionConfiguration
{
    /**
     * @param  class-string  $question
     * @param  int | string | array<string, int | string | null> | null  $cols
     * @param  int | string | array<string, int | string | null> | null  $rows
     */
    final public function __construct(
        readonly public string $question,
        protected array $properties = [],
        protected int | string | array | null $cols = null,
        protected int | string | array | null $rows = null,
    ) {
        $this->cols ??= config('advanced-dashboards-for-filament.questions.cols');
        $this->rows ??= config('advanced-dashboards-for-filament.questions.rows');
    }

    /**
     * @param  class-string  $question
     */
    public static function make(string $question): static
    {
        return new static($question);
    }

    public function properties(array $properties): QuestionConfiguration
    {
        $this->properties = $properties;

        return $this;
    }

    public function cols(int | array | string | null $cols): QuestionConfiguration
    {
        $this->cols = $cols;

        return $this;
    }

    public function rows(int | array | string | null $rows): QuestionConfiguration
    {
        $this->rows = $rows;

        return $this;
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
