<?php

use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Livewire\Components\DevelopersScreen;
use App\Http\Livewire\Components\HomeScreen;
use App\Http\Livewire\Components\InterestScreen;
use App\Http\Livewire\Components\PreferenceScreen;
use App\Http\Livewire\Components\SplashScreen;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', SplashScreen::class)->name('app.splash');
Route::get('home', HomeScreen::class)->name('app.home');

Route::group(['middleware' => 'auth'], function() {
    Route::get('interesses', InterestScreen::class)->name('app.interest');
    Route::get('preferencias', PreferenceScreen::class)->name('app.preference');
    Route::get('desenvolvedores', DevelopersScreen::class)->name('app.developers');
});

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('socialite.redirect-github');

Route::get('/auth/github', GithubController::class);


Route::get('/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('socialite.redirect-google');

Route::get('/auth/google', GoogleController::class);
