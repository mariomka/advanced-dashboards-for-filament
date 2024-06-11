@props([
    'keyPrefix',
    'heading',
    'description',
    'records',
    'columns',
    'isStriped',
    'getColumnState',
    'hasEmptyState',
])
@php
    use Filament\Support\Enums\VerticalAlignment;
    use Filament\Tables\Columns\Column;
    use Mariomka\AdvancedDashboardsForFilament\Questions\EmptyModelForArrayTable;

    $hasHeading = filled($heading);
    $hasDescription = filled((string) $description);
    $hasHeader = $hasHeading || $hasDescription;

    $getHiddenClasses = function (Column $column): ?string {
        if ($breakpoint = $column->getHiddenFrom()) {
            return match ($breakpoint) {
                'sm' => 'sm:hidden',
                'md' => 'md:hidden',
                'lg' => 'lg:hidden',
                'xl' => 'xl:hidden',
                '2xl' => '2xl:hidden',
            };
        }

        if ($breakpoint = $column->getVisibleFrom()) {
            return match ($breakpoint) {
                'sm' => 'hidden sm:table-cell',
                'md' => 'hidden md:table-cell',
                'lg' => 'hidden lg:table-cell',
                'xl' => 'hidden xl:table-cell',
                '2xl' => 'hidden 2xl:table-cell',
            };
        }

        return null;
    };

    $emptyModel = new EmptyModelForArrayTable();
@endphp

<div
    x-ignore
    ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('table', 'filament/tables') }}"
    @class(['adffi-ta fi-ta h-full'])
>
    <x-filament-tables::container class="h-full flex flex-col">
        @if ($hasHeader)
            <div class="fi-ta-header-ctn divide-y divide-gray-200 dark:divide-white/10">
                <x-filament-tables::header
                    :actions-position="null"
                    :description="$description"
                    :heading="$heading"
                />
            </div>
        @endif

        <div
            @class([
                'fi-ta-content flex-1 relative divide-y divide-gray-200 overflow-x-auto dark:divide-white/10 dark:border-t-white/10',
                '!border-t-0' => ! $hasHeader,
            ])
        >
            @if (count($records))
                <x-filament-tables::table>
                    <x-slot name="header">
                        @foreach ($columns as $column)
                            @php
                                $columnWidth = $column->getWidth();
                            @endphp

                            <x-filament-tables::header-cell
                                :alignment="$column->getAlignment()"
                                :name="$column->getName()"
                                :wrap="$column->isHeaderWrapped()"
                                :attributes="
                                \Filament\Support\prepare_inherited_attributes($column->getExtraHeaderAttributeBag())
                                    ->class([
                                        'fi-table-header-cell-' . str($column->getName())->camel()->kebab(),
                                        'w-full' => blank($columnWidth) && $column->canGrow(default: false),
                                        $getHiddenClasses($column),
                                    ])
                                    ->style([
                                        ('width: ' . $columnWidth) => filled($columnWidth),
                                    ])
                            "
                            >
                                {{ $column->getLabel() }}
                            </x-filament-tables::header-cell>
                        @endforeach
                    </x-slot>

                    @if (count($records))
                        @php
                            $isRecordRowStriped = false;
                        @endphp

                        @foreach ($records as $record)
                            @php
                                $recordKey = $loop->index;
                            @endphp

                            <x-filament-tables::row
                                :striped="$isStriped && $isRecordRowStriped"
                                :wire:key="$keyPrefix . '.table.records.' . $recordKey"
                            >
                                @foreach ($columns as $column)
                                    @php
                                        $column
                                            ->record($emptyModel)
                                            ->getStateUsing($getColumnState);
                                        $column->rowLoop($loop->parent);
                                    @endphp

                                    <x-filament-tables::cell
                                        :wire:key="$keyPrefix . '.table.record.' . $recordKey . '.column.' . $column->getName()"
                                        :attributes="
                                                \Filament\Support\prepare_inherited_attributes($column->getExtraCellAttributeBag())
                                                    ->class([
                                                        'fi-table-cell-' . str($column->getName())->camel()->kebab(),
                                                        match ($column->getVerticalAlignment()) {
                                                            VerticalAlignment::Start => 'align-top',
                                                            VerticalAlignment::Center => 'align-middle',
                                                            VerticalAlignment::End => 'align-bottom',
                                                            default => null,
                                                        },
                                                        $getHiddenClasses($column),
                                                    ])
                                            "
                                    >
                                        <x-filament-tables::columns.column
                                            :column="$column"
                                            :record="$record"
                                            :record-key="$recordKey"
                                        />
                                    </x-filament-tables::cell>
                                @endforeach
                            </x-filament-tables::row>

                            @php
                                $isRecordRowStriped = ! $isRecordRowStriped;
                            @endphp
                        @endforeach
                    @endif
                </x-filament-tables::table>
            @elseif ($emptyState = $hasEmptyState->getEmptyState())
                {{ $emptyState }}
            @else
                <tr>
                    <td colspan="{{ count($columns) }}">
                        <x-filament-tables::empty-state
                            :actions="$hasEmptyState->getEmptyStateActions()"
                            :description="$hasEmptyState->getEmptyStateDescription()"
                            :heading="$hasEmptyState->getEmptyStateHeading()"
                            :icon="$hasEmptyState->getEmptyStateIcon()"
                        />
                    </td>
                </tr>
            @endif
        </div>
    </x-filament-tables::container>
</div>
