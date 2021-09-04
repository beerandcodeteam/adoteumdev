<?php

use App\Models\User;
use App\Http\Livewire\Components\KnowledgeScreen;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->seed();
});

it('checks if knowledge url is working', function () {
    $user = User::firstWhere('email', '33piter@adoteum.dev');

    actingAs($user->load('profile'))
        ->get(route('app.knowledge'))
        ->assertOk();
});

it('checks if knowledge form was stored successful', function () {
    $payload = '{"Linguagens":[{"id":1,"category_id":1,"name":"Assembly","level":5}],"Frameworks":[{"id":18,"category_id":2,"name":"Angular.js","level":1}],"Idiomas":[{"id":42,"category_id":3,"name":"Ingl\u00eas","level":2}]}';

    $user = User::firstWhere('email', '33piter@adoteum.dev');

    actingAs($user->load('profile'));

    $test = livewire(KnowledgeScreen::class)
        ->set('payload', json_decode($payload, true, 512, JSON_THROW_ON_ERROR))
        ->call('save');

    assertDatabaseHas('knowledge', [
        'user_id' => $user->id,
    ]);

    $test->assertRedirect(route('app.developers'));
});
