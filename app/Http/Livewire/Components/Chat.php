<?php

namespace App\Http\Livewire\Components;

use App\Events\ChatStatusUpdated;
use Livewire\Component;

class Chat extends Component
{
    public function receivedActions()
    {

    }

    public function mount()
    {
        //ChatStatusUpdated::dispatch('Hello World!');
    }

    public function render()
    {
        return view('livewire.components.chat');
    }
}
