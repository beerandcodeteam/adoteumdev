<?php

use App\Models\User;
use App\Http\Livewire\Components\InterestScreen;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->seed();
});

it('checks if interests url is working', function () {
    $user = User::firstWhere('email', '33piter@adoteum.dev');

    actingAs($user->load('profile'))
        ->get(route('app.interest'))
        ->assertOk();
});

it('checks if interests list was loaded', function () {
    $user = User::firstWhere('email', '33piter@adoteum.dev');

    actingAs($user->load('profile'))
        ->get(route('app.knowledge'))
        ->assertSee("Assembly");
});

it('checks if interests form was stored successful', function () {
    $payload = '{"Linguagens":[{"id":1,"category_id":1,"name":"Assembly","level":5}],"Frameworks":[{"id":18,"category_id":2,"name":"Angular.js","level":1}],"Idiomas":[{"id":42,"category_id":3,"name":"Ingl\u00eas","level":2}]}';

    $user = User::firstWhere('email', '33piter@adoteum.dev');

    actingAs($user->load('profile'));

    $test = livewire(InterestScreen::class)
        ->set('payload', json_decode($payload, true, 512, JSON_THROW_ON_ERROR))
        ->call('save');

    assertDatabaseHas('interests', [
        'user_id' => $user->id,
    ]);

    $test->assertRedirect(route('app.knowledge'));
});
