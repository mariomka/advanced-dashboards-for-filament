<?php

namespace Mariomka\AdvancedDashboardsForFilament;

use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\View;
use Livewire\Features\SupportTesting\Testable;
use Mariomka\AdvancedDashboardsForFilament\Commands\AdvancedDashboardsForFilamentCommand;
use Mariomka\AdvancedDashboardsForFilament\Dashboard\AdvancedDashboard;
use Mariomka\AdvancedDashboardsForFilament\Testing\TestsAdvancedDashboardsForFilament;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AdvancedDashboardsForFilamentServiceProvider extends PackageServiceProvider
{
    public static string $name = 'advanced-dashboards-for-filament';

    public static string $viewNamespace = 'advanced-dashboards-for-filament';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('mariomka/advanced-dashboards-for-filament');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void
    {
    }

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        FilamentView::registerRenderHook(
            PanelsRenderHook::PAGE_HEADER_ACTIONS_BEFORE,
            fn (): View => view('advanced-dashboards-for-filament::dashboard.header-loading-indicator'),
            scopes: AdvancedDashboard::class,
        );

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/advanced-dashboards-for-filament/{$file->getFilename()}"),
                ], 'advanced-dashboards-for-filament-stubs');
            }
        }

        // Testing
        Testable::mixin(new TestsAdvancedDashboardsForFilament());
    }

    protected function getAssetPackageName(): ?string
    {
        return 'mariomka/advanced-dashboards-for-filament';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('advanced-dashboards-for-filament', __DIR__ . '/../resources/dist/components/advanced-dashboards-for-filament.js'),
            Css::make('advanced-dashboards-for-filament-styles', __DIR__ . '/../resources/dist/advanced-dashboards-for-filament.css'),
            Js::make('advanced-dashboards-for-filament-scripts', __DIR__ . '/../resources/dist/advanced-dashboards-for-filament.js'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            AdvancedDashboardsForFilamentCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            'create_advanced-dashboards-for-filament_table',
        ];
    }
}
