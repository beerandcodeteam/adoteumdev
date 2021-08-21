<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class HomeScreen extends Component
{
    public const GOOGLE_DRIVER = 'google';
    public const GITHUB_DRIVER = 'github';

    public function loginWithGoogle()
    {
        return redirect()->route('socialite.redirect', [self::GOOGLE_DRIVER]);
    }

    public function loginWithGithub()
    {
        return redirect()->route('socialite.redirect', [self::GITHUB_DRIVER]);
    }

    public function render()
    {
        return view('livewire.components.home-screen');
    }
}
