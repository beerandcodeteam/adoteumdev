<?php

use App\Http\Livewire\Components\HomeScreen;
use App\Http\Livewire\Components\InterestScreen;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User;

use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

it('checks the Google login button', function(){
    livewire(HomeScreen::class)
        ->call('loginWithGoogle')
        ->assertRedirect('/auth/redirect/google');
});

it('checks the Github login button', function(){
    livewire(HomeScreen::class)
        ->call('loginWithGithub')
        ->assertRedirect('/auth/redirect/github');
});

it('checks auth when automatic login is enabled', function(){
    config(['auth.auto_login' => true]);

    $redirectGoogle = get('/auth/redirect/google');

    $this->followRedirects($redirectGoogle)
        ->assertSeeLivewire(InterestScreen::class);
});

it('checks auth when automatic login is disabled', function(){
    config(['auth.auto_login' => false]);

    $redirectGoogle = get('/auth/redirect/google');

    $this->followRedirects($redirectGoogle)
        ->assertDontSeeLivewire(InterestScreen::class);
});

it("checks a new user's login with Google", function(){
    $socialiteUser = (new User())->map([
        'id' => '12345',
        'name' => 'John Doe',
        'email' => 'john.doe@gmail.com',
        'avatar' => 'https://lh3.googleusercontent.com/12345678/photo.jpg'
    ]);

    Socialite::shouldReceive('driver->user')
        ->andReturn($socialiteUser);

    $authGoogle = get('auth/callback/google');

    $this->followRedirects($authGoogle)
        ->assertSeeLivewire(InterestScreen::class);
});

it("checks a new user's login with Github", function(){
    $socialiteUser = (new User())->map([
        'id' => '12345',
        'nickname' => 'john.doe',
        'email' => 'john.doe@gmail.com',
        'avatar' => 'https://lh3.googleusercontent.com/12345678/photo.jpg'
    ]);

    Socialite::shouldReceive('driver->user')
        ->andReturn($socialiteUser);

    $authGithub = get('auth/callback/github');

    $this->followRedirects($authGithub)
        ->assertSeeLivewire(InterestScreen::class);
});
