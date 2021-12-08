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
use Livewire\Redirector;

class KnowledgeScreen extends Component
{
    public string $typeLoadPage = '';
    public ?array $user = [];
    public ?array $categories = [];
    public ?array $payload = [];

    public function save(): RedirectResponse | Redirector
    {
        try {
            $this->insertKnowledgeData();

            if ($this->typeLoadPage === 'edit') {
                return redirect()->route('app.profile');
            }

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
        $this->typeLoadPage = request('type');
        $this->user = auth()->user()
            ?->load('profile', 'knowledge.skill.category', 'interests')
            ->toArray();
        $this->user['typeResource'] = 'knowledge';
        $this->categories = Category::with('skills')->get()->toArray();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.components.knowledge-screen');
    }
}
