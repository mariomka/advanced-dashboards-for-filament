@props([
    'columns' => [
        'lg' => 6,
    ],
    'rowHeight' => '120px',
    'data' => [],
    'widgets' => [],
])

<x-filament::grid
    :is-grid="true"
    :default="$columns['default'] ?? 1"
    :sm="$columns['sm'] ?? null"
    :md="$columns['md'] ?? null"
    :lg="$columns['lg'] ?? ($columns ? (is_array($columns) ? null : $columns) : 2)"
    :xl="$columns['xl'] ?? null"
    :two-xl="$columns['2xl'] ?? null"
    :attributes="\Filament\Support\prepare_inherited_attributes($attributes)->class('gap-4')"
    :style="'grid-auto-rows: ' . $rowHeight"
>
    @php
        $normalizeWidgetClass = function (string | \Mariomka\AdvancedDashboardsForFilament\Questions\QuestionConfiguration $widget): string {
            if ($widget instanceof \Mariomka\AdvancedDashboardsForFilament\Questions\QuestionConfiguration) {
                return $widget->widget;
            }

            return $widget;
        };
    @endphp

    @foreach ($widgets as $widgetKey => $widget)
        @php
            $widgetClass = $normalizeWidgetClass($widget);
        @endphp

        <div
            class="col-[span_var(--col-span)_/span__var(--col-span)] row-[span_var(--row-span)_/span__var(--row-span)]"
            {{
            $attributes
                ->class([
                    'col-span[--col-span]',
                    'row-span[--row-span]',
                ])
                ->style([
                    '--col-span: ' . ($widget instanceof \Mariomka\AdvancedDashboardsForFilament\Questions\QuestionConfiguration ? $widget->getCols() : 3),
                    '--row-span: ' . ($widget instanceof \Mariomka\AdvancedDashboardsForFilament\Questions\QuestionConfiguration ? $widget->getRows() : 3),
                    // 'height: calc(80px * ' . ($widget instanceof \Presentation\Admin\Pages\Dashboards\DashboardWidget ? $widget->getRows() : 3) . ');',
                ])
        }}
        >
            @livewire(
                $widgetClass,
                [...(($widget instanceof \Mariomka\AdvancedDashboardsForFilament\Questions\QuestionConfiguration) ? [...$widget->widget::getDefaultProperties(), ...$widget->getProperties()] : $widget::getDefaultProperties()), ...$data],
                key("{$widgetClass}-{$widgetKey}"),
            )
        </div>
    @endforeach
</x-filament::grid>
