<?php

namespace App\Http\Livewire\Components;

use App\Models\Category;
use App\Models\Knowledge;
use Livewire\Component;

class KnowledgeScreen extends Component
{
    public ?array $user = [];
    public ?array $categories = [];
    public ?array $payload = [];

    public function save()
    {
        try {
            $this->insertKnowledgeData();

            return redirect()->route('app.developers');
        } catch (\Exception $exception) {
            //todo: adicionar notificação com erro para o usuário (izitoast)
            dd($exception->getMessage());
        }
    }

    private function insertKnowledgeData(): void
    {
        Knowledge::query()->updateOrCreate([
            'user_id' => auth()->user()->id,
        ], [
            'data' => $this->payload,
        ]);
    }

    public function mount(): void
    {
        $this->user = auth()->user()->load('profile')->toArray();
        $this->categories = Category::with('skills')->get()->toArray();
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.components.knowledge-screen');
    }
}
