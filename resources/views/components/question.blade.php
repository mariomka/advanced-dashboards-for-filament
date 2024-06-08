@php
    use Filament\Support\Facades\FilamentView;

    $heading = $this->getHeading();
    $description = $this->getDescription();

    $hasHeading = filled($heading);
    $hasDescription = filled((string) $description);
@endphp

<div
    {{
        $attributes
            ->class(["adffi-question h-full flex flex-col rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10"])
    }}
>
    @if($hasHeading || $hasDescription)
        <header class="px-6 py-4 border-b border-gray-200 dark:border-white/10">
            @if($hasHeading)
                <h3
                    @class([$hasDescription ? 'mb-1' : '', 'text-base font-semibold leading-6 text-gray-950 dark:text-white'])
                >
                    {{ $heading }}
                </h3>
            @endif
            @if ($hasDescription)
                <p
                    @class(['overflow-hidden break-words text-sm text-gray-500 dark:text-gray-400'])
                >
                    {{ $description }}
                </p>
            @endif
        </header>
    @endif
    <div class="adffi-question-content px-4 py-6 flex-1">
        {{ $slot }}
    </div>
</div>
