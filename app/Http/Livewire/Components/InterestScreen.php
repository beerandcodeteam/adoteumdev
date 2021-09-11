<?php

namespace App\Http\Livewire\Components;

use App\Models\Category;
use App\Models\Interest;
use App\Models\User;
use Livewire\Component;

class InterestScreen extends Component
{
    public array $user;
    public ?array $categories = [];
    public ?array $payload = [];

    public function save()
    {
        try {
            $this->insertInterestsData();

            if (userIsDeveloper()) {
                return redirect()->route('app.knowledge');
            }

            return redirect()->route('app.developers');
        } catch (\Exception $exception) {
            //todo: adicionar notificação com erro para o usuário (izitoast)
            dd($exception->getMessage());
        }
    }

    private function insertInterestsData(): void
    {
        Interest::query()->updateOrCreate([
            'user_id' => auth()->user()->id,
        ], [
            'data' => $this->payload,
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
