<?php

use function Pest\Laravel\get;

it('checks if home page is working')
    ->get('/')
    ->assertOk();

it('checks if SplashScreen Component was rendered', function () {
    get('/')
        ->assertSeeLivewire('components.splash-screen');
});

