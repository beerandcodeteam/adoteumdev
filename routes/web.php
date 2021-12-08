<?php

use App\Http\Controllers\Auth\SocialiteCallbackController;
use App\Http\Livewire\Components\Chat;
use App\Http\Livewire\Components\ChatList;
use App\Http\Livewire\Components\DevelopersScreen;
use App\Http\Livewire\Components\HomeScreen;
use App\Http\Livewire\Components\InterestScreen;
use App\Http\Livewire\Components\KnowledgeScreen;
use App\Http\Livewire\Components\ProfileScreen;
use App\Http\Livewire\Components\SplashScreen;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', SplashScreen::class)->name('app.splash');
Route::get('home', HomeScreen::class)->name('app.home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('interesses/{type?}', InterestScreen::class)->name('app.interest');
    Route::get('conhecimentos/{type?}', KnowledgeScreen::class)->name('app.knowledge');
    Route::get('desenvolvedores', DevelopersScreen::class)->name('app.developers');

    Route::get('profile', ProfileScreen::class)->name('app.profile');

    Route::get('chat-list', ChatList::class)->name('app.chat-list');
    Route::get('chat/{user}', Chat::class)->name('app.chat');
});

Route::group(['prefix' => 'auth', 'as' => 'socialite.'], function () {
    Route::get('redirect/{driver}', function (string $driver) {
        return Socialite::driver($driver)->redirect();
    })->name('redirect')->middleware('checkIfAutoLogin');

    Route::get('callback/{driver}', SocialiteCallbackController::class)->name('callback');
});
