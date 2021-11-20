<?php

namespace App\Http\Livewire\Components;

use App\Events\ChatStatusUpdated;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    public $loggedUser;

    public function receivedActions()
    {

    }

    public function mount() {
        $this->loggedUser = User::with('profile', 'interests', 'knowledge', 'sentActions')
            ->find(Auth::user()->id);
    }

//    public function mount()
//    {
//        ChatStatusUpdated::dispatch('Hello World!');
//    }

    public function render()
    {
        return view('livewire.components.chat');
    }
}
