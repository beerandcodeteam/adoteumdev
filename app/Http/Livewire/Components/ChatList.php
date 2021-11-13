<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class ChatList extends Component
{
    // No mount(), criar uma query de actions (received_actions) relacionada com messages
    public function render()
    {
        return view('livewire.components.chat-list');
    }
}
