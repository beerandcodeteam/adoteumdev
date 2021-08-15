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

Route::group(['middleware' => 'auth'], function () {
    Route::get('interesses', InterestScreen::class)->name('app.interest');
    Route::get('preferencias', PreferenceScreen::class)->name('app.preference');
    Route::get('desenvolvedores', DevelopersScreen::class)->name('app.developers');
});

Route::group(['prefix' => 'auth', 'as' => 'socialite.'], function () {
    Route::get('redirect/{driver}', function (string $driver) {
        return Socialite::driver($driver)->redirect();
    })->name('redirect')->middleware('checkIfLocalEnv');

    Route::get('github', GithubController::class)->name('github');

    Route::get('google', GoogleController::class)->name('google');
});
