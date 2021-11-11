<?php

declare(strict_types=1);

namespace App\Http\Livewire\Components;

use App\Models\Category;
use App\Models\Knowledge;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;

class KnowledgeScreen extends Component
{
    public ?array $user = [];
    public ?array $categories = [];
    public ?array $payload = [];

    public function save(): RedirectResponse
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
        foreach ($this->payload as $skill) {
            Knowledge::query()->updateOrCreate([
                'user_id' => auth()->user()->id,
                'skill_id' => $skill['id'],
            ], [
                'level' => $skill['level'],
            ]);
        }
    }

    public function mount(): void
    {
        $this->user = auth()->user()->load('profile')->toArray();
        $this->categories = Category::with('skills')->get()->toArray();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.components.knowledge-screen');
    }
}
