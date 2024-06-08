@php
    use Filament\Support\Facades\FilamentView;

    $color = $this->getColor();
    $heading = $this->getHeading();
    $description = $this->getDescription();

    $hasHeading = filled($heading);
    $hasDescription = filled((string) $description);
@endphp

<x-advanced-dashboards-for-filament::question class="adffi-chart-question">
    <div
        @if (FilamentView::hasSpaMode())
            ax-load="visible"
        @else
            ax-load
        @endif
        ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('chart', 'filament/widgets') }}"
        wire:ignore
        x-data="chart({
                    cachedData: @js($this->getCachedData()),
                    options: @js($this->getOptions()),
                    type: @js($this->getType()),
                })"
        x-ignore
        @class([
            'flex-1',
            match ($color) {
                'gray' => null,
                default => 'fi-color-custom',
            },
            is_string($color) ? "fi-color-{$color}" : null,
        ])
    >
        <canvas x-ref="canvas" class="h-full"></canvas>

        <span
            x-ref="backgroundColorElement"
            @class([
                match ($color) {
                    'gray' => 'text-gray-100 dark:text-gray-800',
                    default => 'text-custom-50 dark:text-custom-400/10',
                },
            ])
            @style([
                \Filament\Support\get_color_css_variables(
                    $color,
                    shades: [50, 400],
                    alias: 'widgets::chart-widget.background',
                ) => $color !== 'gray',
            ])
        ></span>

        <span
            x-ref="borderColorElement"
            @class([
                match ($color) {
                    'gray' => 'text-gray-400',
                    default => 'text-custom-500 dark:text-custom-400',
                },
            ])
            @style([
                \Filament\Support\get_color_css_variables(
                    $color,
                    shades: [400, 500],
                    alias: 'widgets::chart-widget.border',
                ) => $color !== 'gray',
            ])
        ></span>

        <span
            x-ref="gridColorElement"
            class="text-gray-200 dark:text-gray-800"
        ></span>

        <span
            x-ref="textColorElement"
            class="text-gray-500 dark:text-gray-400"
        ></span>
    </div>
</x-advanced-dashboards-for-filament::question>
