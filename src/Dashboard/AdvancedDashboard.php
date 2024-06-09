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

    protected static string $view = 'advanced-dashboards-for-filament::dashboard.advanced-dashboard';

    protected static ?string $pollingInterval = null;

    protected static bool $showFullscreenButton = false;

    protected function getViewData(): array
    {
        return [
            'loadCss' => config('advanced-dashboards-for-filament.load_css'),
        ];
    }

    public function getRenderHookScopes(): array
    {
        return [
            ...parent::getRenderHookScopes(),
            self::class,
        ];
    }

    protected function getPollingInterval(): ?string
    {
        return static::$pollingInterval;
    }

    public function getRowHeight(): string
    {
        return config('advanced-dashboards-for-filament.grid.row_height');
    }

    /**
     * @return int | string | array<string, int | string | null>
     */
    public function getColumns(): int | string | array
    {
        return config('advanced-dashboards-for-filament.grid.columns');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('refresh')
                ->label(__('advanced-dashboards-for-filament::default.refresh'))
                ->icon('heroicon-o-arrow-path')
                ->iconButton()
                ->action('$refresh'),
            ...(
                $this->showFullscreenButton() ?
                [
                    Action::make('toggle_enter_fullscreen')
                        ->view('advanced-dashboards-for-filament::dashboard.toggle-fullscreen-action'),
                ]
                : []
            ),
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
                ->columns($this->filtersColumns())
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

    /**
     * @return array<string, int | string | null> | int | string | null
     */
    protected function filtersColumns(): array | int | string | null
    {
        return config('advanced-dashboards-for-filament.filters.columns');
    }

    public function showFiltersForm(): bool
    {
        return filled($this->filtersSchema());
    }

    public function showFullscreenButton(): bool
    {
        return static::$showFullscreenButton;
    }

    /**
     * @return array<class-string<Question> | QuestionConfiguration>
     */
    abstract public function getQuestions(): array;
}
