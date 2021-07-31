<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class InterestScreen extends Component
{

    public $user;

    public function mount() {
        $this->user = auth()->user()->load('profile');
    }

    public function render()
    {
        return view('livewire.components.interest-screen');
    }
}
