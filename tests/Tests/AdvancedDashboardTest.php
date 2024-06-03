<?php

use Mariomka\AdvancedDashboardsForFilament\Tests\Models\User;
use Mariomka\AdvancedDashboardsForFilament\Tests\Pages\TestDashboard;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

it('visits the dashboard', function () {
    actingAs(User::factory()->create())
        ->get(TestDashboard::getUrl())
        ->assertSuccessful();
});

it('sees the dashboard', function () {
    livewire(TestDashboard::class)
        ->assertSee('Test Dashboard');
});
