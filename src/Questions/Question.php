<?php

namespace Mariomka\AdvancedDashboardsForFilament\Questions;

use Filament\Support\Concerns\CanBeLazy;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Livewire\Component;

abstract class Question extends Component
{
    use CanBeLazy;
    use InteractsWithPageFilters;

    protected static bool $isDiscovered = true;

    /**
     * @var view-string
     */
    protected static string $view;

    protected static ?string $heading = null;

    protected static ?string $description = null;

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

    public function getHeading(): string | Htmlable | null
    {
        return static::$heading;
    }

    public function getDescription(): string | Htmlable | null
    {
        return static::$description;
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

    public function placeholder(): View
    {
        return view(
            'advanced-dashboards-for-filament::questions.loading-question',
        );
    }
}
