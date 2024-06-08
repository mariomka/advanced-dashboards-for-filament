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
            ->class(["adffi-question h-full flex flex-col p-4 rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10"])
    }}
>
    @if($hasHeading)
        <h3
            @class([$hasDescription ? 'mb-1' : 'mb-4', 'text-base font-semibold leading-6 text-gray-950 dark:text-white'])
        >
            {{ $heading }}
        </h3>
    @endif
    @if ($hasDescription)
        <p
            @class(['mb-4 overflow-hidden break-words text-sm text-gray-500 dark:text-gray-400'])
        >
            {{ $description }}
        </p>
    @endif
    <div class="adffi-question-content">
        {{ $slot }}
    </div>
</div>
