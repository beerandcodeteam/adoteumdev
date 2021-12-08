<?php

declare(strict_types=1);

namespace App\Http\Livewire\Components;

use App\Models\Category;
use App\Models\Interest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Redirector;

class InterestScreen extends Component
{
    public string $typeLoadPage = '';
    public array $user;
    public ?array $categories = [];
    public ?array $payload = [];

    public function save(): RedirectResponse | Redirector
    {
        try {
            $this->insertInterestsData();

            if (userIsDeveloper()) {
                if ($this->typeLoadPage === 'edit') {
                    return redirect()->route('app.profile');
                }
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
        foreach ($this->payload as $skill) {
            Interest::query()->updateOrCreate([
                'user_id' => auth()->user()->id,
                'skill_id' => $skill['id'],
            ],[
                'level' => $skill['level'],
            ]);
        }
    }

    public function mount(): void
    {
        $this->typeLoadPage = request('type');
        $this->user = auth()->user()
            ?->load('profile', 'interests.skill.category', 'knowledge')
            ->toArray();
        $this->user['typeResource'] = 'interests';
        $this->categories = Category::with('skills:id,category_id,name')
            ->select('id', 'name')
            ->get()
            ->toArray();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.components.interest-screen');
    }
}
