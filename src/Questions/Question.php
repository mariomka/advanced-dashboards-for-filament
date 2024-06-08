<?php

namespace Mariomka\AdvancedDashboardsForFilament\Questions;

use Filament\Support\Concerns\CanBeLazy;
use Illuminate\Contracts\View\View;
use Livewire\Component;

abstract class Question extends Component
{
    use CanBeLazy;

    protected static bool $isDiscovered = true;

    /**
     * @var view-string
     */
    protected static string $view;

    /**
     * @return array<string, mixed>
     */
    protected function getViewData(): array
    {
        return [];
    }

    public static function isDiscovered(): bool
    {
        return static::$isDiscovered;
    }

    public function render(): View
    {
        return view(static::$view, $this->getViewData());
    }

    /**
     * @param  array<string, mixed>  $properties
     */
    public static function make(array $properties = []): QuestionConfiguration
    {
        return app(QuestionConfiguration::class, ['question' => static::class, 'properties' => $properties]);
    }

    /**
     * @return array<string, mixed>
     */
    public static function getDefaultProperties(): array
    {
        $properties = [];

        if (static::isLazy()) {
            $properties['lazy'] = true;
        }

        return $properties;
    }
}
