<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\Components\HomeScreen;
use App\Http\Livewire\Components\SplashScreen;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', SplashScreen::class)->name('app.splash');
Route::get('home', HomeScreen::class)->name('app.home');

// 1 - Criar a rota para carregar a tela de interesses

// 2 - Criar a rota para carregar a tela de preferências

// 3 - Criar a rota para carregar a tela de listagem de desenvolvedores


Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('socialite.redirect-github');

Route::get('/auth/github', GithubController::class);
