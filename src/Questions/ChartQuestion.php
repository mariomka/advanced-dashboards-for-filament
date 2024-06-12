<?php

namespace Mariomka\AdvancedDashboardsForFilament\Questions;

use Filament\Support\RawJs;
use Livewire\Attributes\Locked;

abstract class ChartQuestion extends Question
{
    /**
     * @var array<string, mixed> | null
     */
    protected ?array $cachedData = null;

    #[Locked]
    public ?string $dataChecksum = null;

    protected static string $color = 'primary';

    /**
     * @var array<string, mixed> | null
     */
    protected static ?array $options = [
        'maintainAspectRatio' => false,
    ];

    /**
     * @var view-string
     */
    protected static string $view = 'advanced-dashboards-for-filament::questions.chart-question';

    public function mount(): void
    {
        $this->dataChecksum = $this->generateDataChecksum();
    }

    abstract protected function getType(): string;

    protected function generateDataChecksum(): string
    {
        return md5(json_encode($this->getCachedData()));
    }

    /**
     * @return array<string, mixed>
     */
    protected function getCachedData(): array
    {
        return $this->cachedData ??= $this->getData();
    }

    /**
     * @return array<string, mixed>
     */
    protected function getData(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed> | RawJs | null
     */
    protected function getOptions(): array | RawJs | null
    {
        return static::$options;
    }

    public function updateChartData(): void
    {
        $newDataChecksum = $this->generateDataChecksum();

        if ($newDataChecksum !== $this->dataChecksum) {
            $this->dataChecksum = $newDataChecksum;

            $this->dispatch('updateChartData', data: $this->getCachedData());
        }
    }

    public function rendering(): void
    {
        $this->updateChartData();
    }

    public function getColor(): string
    {
        return static::$color;
    }
}
