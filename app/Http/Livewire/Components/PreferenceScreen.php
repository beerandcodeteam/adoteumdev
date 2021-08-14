<?php

namespace App\Http\Livewire\Components;

use App\Models\Category;
use Livewire\Component;

class PreferenceScreen extends Component
{

    public $user;
    public $categories;
    public $payload;

    public function mount() {
        $this->user = auth()->user()->load('profile')->toArray();
        $this->categories = Category::with('skills')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.components.preference-screen');
    }

    public function save() {
        dd("ICARO QUE LUTE", $this->payload);
    }
}
