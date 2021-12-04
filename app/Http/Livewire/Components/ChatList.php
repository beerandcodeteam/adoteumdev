<?php

namespace App\Http\Livewire\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatList extends Component
{

    public $loggedUser;

    public function mount() {
        $this->loggedUser = User::with('profile', 'interests', 'knowledge', 'sentActions')
            ->find(Auth::user()->id);
    }
    public function render()
    {
        return view('livewire.components.chat-list');
    }
}
