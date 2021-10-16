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

it('stores interests form', function () {
    $payload = [
        ['id' => 1, 'level' => 3, 'category_id' => 1],
        ['id' => 2, 'level' => 4, 'category_id' => 1],
        ['id' => 3, 'level' => 1, 'category_id' => 1],
        ['id' => 4, 'level' => 5, 'category_id' => 1],
    ];

    $user = User::firstWhere('email', '33piter@adoteum.dev');

    $this->assertDatabaseMissing('interests', ['user_id' => $user->id]);

    actingAs($user->load('profile'));

    livewire(InterestScreen::class)
        ->set('payload', $payload)
        ->call('save')
        ->assertRedirect(route('app.knowledge'));

    $this->assertDatabaseHas('interests', ['user_id' => $user->id]);
});
