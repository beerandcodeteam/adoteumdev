<?php

namespace App\Http\Livewire\Components;

use App\Models\Category;
use Livewire\Component;

class InterestScreen extends Component
{

    public $user;
    public $categories;

    public function mount() {
        $this->user = auth()->user()->load('profile')->toArray();
        $this->categories = Category::with('skills')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.components.interest-screen');
    }
}
