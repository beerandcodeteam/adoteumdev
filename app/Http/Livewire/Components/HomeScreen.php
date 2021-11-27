<?php

namespace App\Http\Livewire\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Redirector;

class HomeScreen extends Component
{
    public const GOOGLE_DRIVER = 'google';
    public const GITHUB_DRIVER = 'github';

    public function loginWithGoogle(): RedirectResponse|Redirector
    {
        return redirect()->route('socialite.redirect', [self::GOOGLE_DRIVER]);
    }

    public function loginWithGithub(): RedirectResponse|Redirector
    {
        return redirect()->route('socialite.redirect', [self::GITHUB_DRIVER]);
    }

    public function render(): Factory|View
    {
        return view('livewire.components.home-screen');
    }
}
