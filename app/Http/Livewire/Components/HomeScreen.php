<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class HomeScreen extends Component
{
    public function loginWithGoogle()
    {
        return redirect()->route('socialite.redirect-google');
    }

    public function loginWithGithub()
    {
        return redirect()->route('socialite.redirect-github');
    }

    public function render()
    {
        return view('livewire.components.home-screen');
    }
}
