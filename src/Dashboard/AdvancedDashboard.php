<?php

namespace Mariomka\AdvancedDashboardsForFilament\Dashboard;

use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Pages\Page;
use Mariomka\AdvancedDashboardsForFilament\Questions\Question;
use Mariomka\AdvancedDashboardsForFilament\Questions\QuestionConfiguration;

abstract class AdvancedDashboard extends Page
{
    use HasFiltersForm;

    protected static string $view = 'advanced-dashboards-for-filament::dashboard.dashboard';

    public function getRenderHookScopes(): array
    {
        return [
            ...parent::getRenderHookScopes(),
            self::class,
        ];
    }

    public function getRowHeight(): string
    {
        return '120px';
    }

    /**
     * @return int | string | array<string, int | string | null>
     */
    public function getColumns(): int | string | array
    {
        return 6;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Refresh')
                ->label(__('advanced-dashboards-for-filament::default.refresh'))
                ->icon('heroicon-o-arrow-path')
                ->iconButton()
                ->action('$refresh'),
        ];
    }

    public function getFiltersForm(): Form
    {
        if ((! $this->isCachingForms) && $this->hasCachedForm('filtersForm')) {
            return $this->getForm('filtersForm');
        }

        return $this->filtersForm(
            $this
                ->makeForm()
                ->columns([
                    'md' => 2,
                    'xl' => 3,
                    '2xl' => 4,
                ])
                ->statePath('filters')
                ->debounce()
        );
    }

    public function filtersForm(Form $form): Form
    {
        return $form->schema($this->filtersSchema());
    }

    protected function filtersSchema(): array
    {
        return [];
    }

    public function showFiltersForm(): bool
    {
        return filled($this->filtersSchema());
    }

    /**
     * @return array<class-string<Question> | QuestionConfiguration>
     */
    abstract public function getQuestions(): array;
}
