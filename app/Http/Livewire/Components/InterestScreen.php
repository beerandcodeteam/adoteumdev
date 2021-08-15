<?php

namespace App\Http\Livewire\Components;

use App\Models\Category;
use Livewire\Component;

class InterestScreen extends Component
{
    public $user;
    public $categories;
    public $payload;

    public function mount()
    {
        $this->user = auth()->user()->load('profile')->toArray();
        $this->categories = Category::with('skills')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.components.interest-screen');
    }

    public function save()
    {
//        dd($this->payload, $this->categories);
        //TODO::SO ENVIAR SE O CARA FOR DEVELOPERMENT
        return redirect()->route('app.preference');
    }
}
