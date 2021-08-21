<?php

namespace App\Http\Livewire\Components;

use App\Models\Category;
use App\Models\Preference;
use Livewire\Component;

class PreferenceScreen extends Component
{
    public $user;
    public $categories;
    public $payload;

    public function save()
    {
        try {
            $this->insertPreferencesData();

            return redirect()->route('app.developers');
        } catch (\Exception $exception) {
            //todo: adicionar notificação com erro para o usuário (izitoast)
            dd($exception->getMessage());
        }
    }

    private function insertPreferencesData(): void
    {
        Preference::updateOrCreate([
            'user_id' => auth()->user()->id,
        ], [
            'data' => json_encode($this->payload)
        ]);
    }

    public function mount()
    {
        $this->user = auth()->user()->load('profile')->toArray();
        $this->categories = Category::with('skills')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.components.preference-screen');
    }
}
