<?php

use Mariomka\AdvancedDashboardsForFilament\Tests\Models\User;
use Mariomka\AdvancedDashboardsForFilament\Tests\Pages\TestDashboard;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

it('sees the dashboard', function () {
    actingAs(User::factory()->create());

    livewire(TestDashboard::class)
        ->assertSuccessful();
});
