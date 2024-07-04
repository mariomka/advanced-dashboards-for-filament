<?php

namespace Mariomka\AdvancedDashboardsForFilament\Commands;

use Filament\Facades\Filament;
use Filament\Panel;
use Filament\Support\Commands\Concerns\CanManipulateFiles;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

#[AsCommand(name: 'make:filament-question')]
class MakeQuestionCommand extends Command
{
    use CanManipulateFiles;

    protected $description = 'Create a new Advanced Dashboard For Filament question class';

    protected $signature = 'make:filament-question {name?} {--C|chart} {--S|stat} {--T|table} {--A|array-table} {--panel=} {--F|force}';

    public function handle(): int
    {
        $question = (string) str($this->argument('name') ?? text(
            label: 'What is the question name?',
            placeholder: 'BlogPostsChart',
            required: true,
        ))
            ->trim('/')
            ->trim('\\')
            ->trim(' ')
            ->replace('/', '\\');
        $questionClass = (string) str($question)->afterLast('\\');
        $questionNamespace = str($question)->contains('\\') ?
            (string) str($question)->beforeLast('\\') :
            '';

        $type = match (true) {
            $this->option('chart') => 'Chart',
            $this->option('stat') => 'Stat',
            $this->option('table') => 'Table',
            $this->option('array-table') => 'ArrayTable',
            default => select(
                label: 'What type of question do you want to create?',
                options: ['Chart', 'Stat', 'Table', 'ArrayTable', 'Custom'],
            ),
        };

        $panel = null;

        if (class_exists(Panel::class)) {
            $panel = $this->option('panel');

            if ($panel) {
                $panel = Filament::getPanel($panel);
            }

            if (! $panel) {
                $panels = Filament::getPanels();
                $namespace = config('livewire.class_namespace');

                /** @var ?Panel $panel */
                $panel = $panels[select(
                    label: 'Where would you like to create this?',
                    options: array_unique([
                        ...array_map(
                            fn (Panel $panel): string => "The [{$panel->getId()}] panel",
                            $panels,
                        ),
                        $namespace => "[{$namespace}] alongside other Livewire components",
                    ])
                )] ?? null;
            }
        }

        $namespace = null;

        if (! $panel) {
            $namespace = config('livewire.class_namespace');
            $path = app_path((string) str($namespace)->after('App\\')->replace('\\', '/'));
        } else {
            $questionDirectories = $panel->getQuestionDirectories();
            $questionNamespaces = $panel->getQuestionNamespaces();

            $namespace = (count($questionNamespaces) > 1) ?
                select(
                    label: 'Which namespace would you like to create this in?',
                    options: $questionNamespaces,
                ) :
                (Arr::first($questionNamespaces) ?? 'App\\Filament\\Questions');
            $path = (count($questionDirectories) > 1) ?
                $questionDirectories[array_search($namespace, $questionNamespaces)] :
                (Arr::first($questionDirectories) ?? app_path('Filament/Questions/'));
        }

        $view = str($question)->prepend(
            (string) str(($panel ? "{$namespace}\\" : 'livewire\\'))
                ->replaceFirst('App\\', '')
        )
            ->replace('\\', '/')
            ->explode('/')
            ->map(fn ($segment) => Str::lower(Str::kebab($segment)))
            ->implode('.');

        $path = (string) str($question)
            ->prepend('/')
            ->prepend($path)
            ->replace('\\', '/')
            ->replace('//', '/')
            ->append('.php');

        $viewPath = resource_path(
            (string) str($view)
                ->replace('.', '/')
                ->prepend('views/')
                ->append('.blade.php'),
        );

        if (! $this->option('force') && $this->checkForCollision([
            $path,
            ...($this->option('stat') || $this->option('chart')) ? [] : [$viewPath],
        ])) {
            return static::INVALID;
        }

        if ($type === 'Chart') {
            $chartType = select(
                label: 'Which type of chart would you like to create?',
                options: [
                    'Bar chart',
                    'Bubble chart',
                    'Doughnut chart',
                    'Line chart',
                    'Pie chart',
                    'Polar area chart',
                    'Radar chart',
                    'Scatter chart',
                ],
            );

            $this->copyStubToApp('ChartQuestion', $path, [
                'class' => $questionClass,
                'namespace' => $namespace . ($questionNamespace !== '' ? "\\{$questionNamespace}" : ''),
                'type' => match ($chartType) {
                    'Bar chart' => 'bar',
                    'Bubble chart' => 'bubble',
                    'Doughnut chart' => 'doughnut',
                    'Pie chart' => 'pie',
                    'Polar area chart' => 'polarArea',
                    'Radar chart' => 'radar',
                    'Scatter chart' => 'scatter',
                    default => 'line',
                },
            ]);
        } elseif ($type === 'Stat') {
            $this->copyStubToApp('StatQuestion', $path, [
                'class' => $questionClass,
                'namespace' => $namespace . ($questionNamespace !== '' ? "\\{$questionNamespace}" : ''),
            ]);
        } elseif ($type === 'Table') {
            $this->copyStubToApp('TableQuestion', $path, [
                'class' => $questionClass,
                'namespace' => $namespace . ($questionNamespace !== '' ? "\\{$questionNamespace}" : ''),
            ]);
        } elseif ($type === 'ArrayTable') {
            $this->copyStubToApp('ArrayTableQuestion', $path, [
                'class' => $questionClass,
                'namespace' => $namespace . ($questionNamespace !== '' ? "\\{$questionNamespace}" : ''),
            ]);
        } else {
            $this->copyStubToApp('Question', $path, [
                'class' => $questionClass,
                'namespace' => $namespace . ($questionNamespace !== '' ? "\\{$questionNamespace}" : ''),
                'view' => $view,
            ]);

            $this->copyStubToApp('QuestionView', $viewPath);
        }

        $this->components->info("Filament question [{$path}] created successfully.");

        return static::SUCCESS;
    }
}
