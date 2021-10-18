<?php

namespace App\Http\Livewire\Components;

use App\Http\Livewire\Core\Component;

class SplashScreen extends Component
{
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.components.splash-screen');
    }
}
