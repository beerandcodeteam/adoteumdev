<?php

use App\Models\User;
use App\Http\Livewire\Components\InterestScreen;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;

it('checks if interests url is working', function () {
    $user = User::firstWhere('email', '33piter@adoteum.dev');

    actingAs($user->load('profile'))
        ->get(route('app.interest'))
        ->assertOk();
});

it('checks if interests list was loaded', function () {
    $user = User::firstWhere('email', '33piter@adoteum.dev');

    actingAs($user->load('profile'))
        ->get(route('app.interest'))
        ->assertSee("Assembly");
});

it('checks if interests form was stored successful', function () {
    $payload = [
        ['skill_id' => 1, 'level' => 3, 'category_id' => 1],
        ['skill_id' => 2, 'level' => 4, 'category_id' => 1],
        ['skill_id' => 3, 'level' => 1, 'category_id' => 1],
        ['skill_id' => 4, 'level' => 5, 'category_id' => 1],
    ];

    $user = User::firstWhere('email', '33piter@adoteum.dev');

    actingAs($user->load('profile'));

    $test = livewire(InterestScreen::class)
        ->set('payload', $payload)
        ->call('save');

    assertDatabaseHas('interests', [
        'user_id' => $user->id,
    ]);

    $test->assertRedirect(route('app.knowledge'));
});
