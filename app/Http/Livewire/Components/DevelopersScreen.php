<?php

namespace App\Http\Livewire\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DevelopersScreen extends Component
{
    public User $loggedUser;
    public array $developers;

    public function mount(): void
    {
        $this->loggedUser = User::with(['profile', 'interests', 'knowledge'])->find(Auth::user()->id);

        $this->developers = User::with(['profile', 'interests', 'knowledge'])->get()->toArray();
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.components.developers-screen');
    }
}
