<?php

namespace Mariomka\AdvancedDashboardsForFilament\Commands;

use Filament\Clusters\Cluster;
use Filament\Facades\Filament;
use Filament\Panel;
use Filament\Support\Commands\Concerns\CanIndentStrings;
use Filament\Support\Commands\Concerns\CanManipulateFiles;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Symfony\Component\Console\Attribute\AsCommand;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

#[AsCommand(name: 'make:filament-advanced-dashboard')]
class MakeAdvancedDashboardCommand extends Command
{
    use CanIndentStrings;
    use CanManipulateFiles;

    protected $description = 'Create a new Advanced Dashboard For Filament dashboard class';

    protected $signature = 'make:filament-advanced-dashboard {name?} {--panel=} {--F|force}';

    public function handle(): int
    {
        $page = (string) str(
            $this->argument('name') ??
            text(
                label: 'What is the dashboard name?',
                placeholder: 'SalesDashboard',
                required: true,
            ),
        )
            ->trim('/')
            ->trim('\\')
            ->trim(' ')
            ->replace('/', '\\');
        $pageClass = (string) str($page)->afterLast('\\');
        $pageNamespace = str($page)->contains('\\') ?
            (string) str($page)->beforeLast('\\') :
            '';

        $panel = $this->option('panel');

        if ($panel) {
            $panel = Filament::getPanel($panel);
        }

        if (! $panel) {
            $panels = Filament::getPanels();

            /** @var Panel $panel */
            $panel = (count($panels) > 1) ? $panels[select(
                label: 'Which panel would you like to create this in?',
                options: array_map(
                    fn (Panel $panel): string => $panel->getId(),
                    $panels,
                ),
                default: Filament::getDefaultPanel()->getId()
            )] : Arr::first($panels);
        }

        $pageDirectories = $panel->getPageDirectories();
        $pageNamespaces = $panel->getPageNamespaces();

        $namespace = (count($pageNamespaces) > 1) ?
            select(
                label: 'Which namespace would you like to create this in?',
                options: $pageNamespaces
            ) :
            (Arr::first($pageNamespaces) ?? 'App\\Filament\\Pages');
        $path = (count($pageDirectories) > 1) ?
            $pageDirectories[array_search($namespace, $pageNamespaces)] :
            (Arr::first($pageDirectories) ?? app_path('Filament/Pages/'));

        $path = (string) str($page)
            ->prepend('/')
            ->prepend($path)
            ->replace('\\', '/')
            ->replace('//', '/')
            ->append('.php');

        $files = [$path];

        if (! $this->option('force') && $this->checkForCollision($files)) {
            return static::INVALID;
        }

        $potentialCluster = (string) str($namespace)->beforeLast('\Pages');
        $clusterAssignment = null;
        $clusterImport = null;

        if (
            filled($potentialCluster) &&
            class_exists($potentialCluster) &&
            is_subclass_of($potentialCluster, Cluster::class)
        ) {
            $clusterAssignment = $this->indentString(PHP_EOL . PHP_EOL . 'protected static ?string $cluster = ' . class_basename($potentialCluster) . '::class;');
            $clusterImport = "use {$potentialCluster};" . PHP_EOL;
        }

        $this->copyStubToApp('AdvancedDashboard', $path, [
            'class' => $pageClass,
            'clusterAssignment' => $clusterAssignment,
            'clusterImport' => $clusterImport,
            'namespace' => $namespace . ($pageNamespace !== '' ? "\\{$pageNamespace}" : ''),
        ]);

        $this->components->info("Filament advanced dashboard [{$path}] created successfully.");

        return static::SUCCESS;
    }
}
