<?php

namespace App\Http\Livewire\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DevelopersScreen extends Component
{
    public User $loggedUser;
    public array $developers;

    public function mount()
    {
        $this->loggedUser = User::with(['profile', 'interest', 'knowledge'])->find(Auth::user()->id);

        $this->developers = User::with(['profile', 'interest', 'knowledge'])->get()->toArray();

       dd(
           auth()->user()->id,
           $this->loggedUser->interest->toArray(),
           $this->loggedUser->interest->topSkill()->first(),
       );
    }

    public function render()
    {
        return view('livewire.components.developers-screen');
    }
}
