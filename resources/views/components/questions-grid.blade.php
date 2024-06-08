@props([
    'columns' => [
        'lg' => 6,
    ],
    'rowHeight' => '140px',
    'data' => [],
    'questions' => [],
])
@php
    use Mariomka\AdvancedDashboardsForFilament\Questions\QuestionConfiguration;
    use Mariomka\AdvancedDashboardsForFilament\Questions\Question;
@endphp

<x-filament::grid
    :is-grid="true"
    :default="$columns['default'] ?? ($columns ? (is_array($columns) ? null : $columns) : 3)"
    :sm="$columns['sm'] ?? null"
    :md="$columns['md'] ?? null"
    :lg="$columns['lg'] ?? null"
    :xl="$columns['xl'] ?? null"
    :two-xl="$columns['2xl'] ?? null"
    :attributes="\Filament\Support\prepare_inherited_attributes($attributes)->class('adffi-questions-grid gap-6')"
    :style="'grid-auto-rows: ' . $rowHeight"
>
    @php
        $normalizeQuestionConfiguration = function (string | QuestionConfiguration $question): QuestionConfiguration {
            if ($question instanceof QuestionConfiguration) {
                return $question;
            }

            /** @var class-string<Question> $question */
            return $question::make();
        };
    @endphp

    @foreach ($questions as $questionKey => $question)
        @php
            $questionConfiguration = $normalizeQuestionConfiguration($question);

            $cols = $questionConfiguration->getCols();
            $colsDefault = $cols['default'] ?? ($cols ? (is_array($cols) ? null : $cols) : 3);
            $colsSm = $cols['sm'] ?? null;
            $colsMd = $cols['md'] ?? null;
            $colsLg = $cols['lg'] ?? null;
            $colsXl = $cols['xl'] ?? null;
            $cols2xl = $cols['2xl'] ?? null;

            $rows = $questionConfiguration->getRows();
            $rowsDefault = $rows['default'] ?? ($rows ? (is_array($rows) ? null : $rows) : 3);
            $rowsSm = $rows['sm'] ?? null;
            $rowsMd = $rows['md'] ?? null;
            $rowsLg = $rows['lg'] ?? null;
            $rowsXl = $rows['xl'] ?? null;
            $rows2xl = $rows['2xl'] ?? null;
        @endphp

        <div
            {{
            $attributes
                ->class([
                    'col-[span_var(--col-span-default)_/span__var(--col-span-default)]' => $colsDefault,
                    'sm:col-[span_var(--col-span-sm)_/span__var(--col-span-sm)]' => $colsSm,
                    'md:col-[span_var(--col-span-md)_/span__var(--col-span-md)]' => $colsMd,
                    'lg:col-[span_var(--col-span-lg)_/span__var(--col-span-lg)]' => $colsLg,
                    'xl:col-[span_var(--col-span-xl)_/span__var(--col-span-xl)]' => $colsXl,
                    '2xl:col-[span_var(--col-span-2xl)_/span__var(--col-span-2xl)]' => $cols2xl,
                    'row-[span_var(--row-span-default)_/span__var(--row-span-default)]' => $rowsDefault,
                    'sm:row-[span_var(--row-span-sm)_/span__var(--row-span-sm)]' => $rowsSm,
                    'md:row-[span_var(--row-span-md)_/span__var(--row-span-md)]' => $rowsMd,
                    'lg:row-[span_var(--row-span-lg)_/span__var(--row-span-lg)]' => $rowsLg,
                    'xl:row-[span_var(--row-span-xl)_/span__var(--row-span-xl)]' => $rowsXl,
                    '2xl:row-[span_var(--row-span-2xl)_/span__var(--row-span-2xl)]' => $rows2xl,
                ])
                ->style([
                    "--col-span-default: {$colsDefault}" => $colsDefault,
                    "--col-span-sm: {$colsSm}" => $colsSm,
                    "--col-span-md: {$colsMd}" => $colsMd,
                    "--col-span-lg: {$colsLg}" => $colsLg,
                    "--col-span-xl: {$colsXl}" => $colsXl,
                    "--col-span-2xl: {$cols2xl}" => $cols2xl,
                    "--row-span-default: {$rowsDefault}" => $rowsDefault,
                    "--row-span-sm: {$rowsSm}" => $rowsSm,
                    "--row-span-md: {$rowsMd}" => $rowsMd,
                    "--row-span-lg: {$rowsLg}" => $rowsLg,
                    "--row-span-xl: {$rowsXl}" => $rowsXl,
                    "--row-span-2xl: {$rows2xl}" => $rows2xl,
                ])
        }}
        >
            @livewire(
                $questionConfiguration->question,
                [...$questionConfiguration->question::getDefaultProperties(), ...$questionConfiguration->getProperties(), ...$data],
                key("{$questionConfiguration->question}-{$questionKey}"),
            )
        </div>
    @endforeach
</x-filament::grid>
