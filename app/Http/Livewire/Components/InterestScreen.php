<?php

namespace App\Http\Livewire\Components;

use App\Models\Category;
use App\Models\Interest;
use Livewire\Component;

class InterestScreen extends Component
{
    public $user;
    public $categories;
    public $payload;

    public function save()
    {
        try {
            $this->insertInterestsData();

            if (userIsDeveloper()) {
                return redirect()->route('app.preference');
            }

            return redirect()->route('app.developers');
        } catch (\Exception $exception) {
            //todo: adicionar notificação com erro para o usuário (izitoast)
            dd($exception->getMessage());
        }
    }

    private function insertInterestsData(): void
    {
        Interest::updateOrCreate([
            'user_id' => auth()->user()->id,
        ], [
            'data' => json_encode($this->payload)
        ]);
    }

    public function mount()
    {
        $this->user = auth()->user()->load('profile')->toArray();
        $this->categories = Category::with('skills:id,category_id,name')
            ->select('id', 'name')
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.components.interest-screen');
    }
}
