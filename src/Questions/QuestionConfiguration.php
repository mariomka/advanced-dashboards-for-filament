<?php

namespace Mariomka\AdvancedDashboardsForFilament\Questions;

use Filament\Widgets\WidgetConfiguration;

class QuestionConfiguration extends WidgetConfiguration {
    public function __construct(
        string $widget,
        array $properties = [],
        protected int $cols = 3,
        protected int $rows = 3,
    ) {
        parent::__construct($widget, $properties);
    }

    public function getCols(): int {
        return $this->cols;
    }

    public function getRows(): int {
        return $this->rows;
    }
}
