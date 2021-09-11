<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class HomeScreen extends Component
{
    public const GOOGLE_DRIVER = 'google';
    public const GITHUB_DRIVER = 'github';

    public function loginWithGoogle(): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('socialite.redirect', [self::GOOGLE_DRIVER]);
    }

    public function loginWithGithub(): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('socialite.redirect', [self::GITHUB_DRIVER]);
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.components.home-screen');
    }
}
