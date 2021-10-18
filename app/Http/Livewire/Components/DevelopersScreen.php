<?php

declare(strict_types=1);

namespace App\Http\Livewire\Components;

use App\Models\Action;
use App\Models\Interest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Core\Component;

class DevelopersScreen extends Component
{
    public mixed $loggedUser;

    public mixed $developers;

    public function action($toUserId, $actionName): void
    {
        Action::updateOrCreate([
            'from_user_id' => $this->loggedUser->id,
            'to_user_id' => $toUserId,
            'name' => $actionName,
            'expiration_at' => now()->addDays(15),
        ]);
    }

    public function mount(): void
    {
        $this->loggedUser = User::with('profile', 'interests', 'knowledge', 'sentActions')
            ->find(Auth::user()->id);

        $this->getDevelopers();
    }

    public function getDevelopers(string $page = '1'): void
    {
        $this->developers = User::select('id', 'name')
            ->with([
                'profile',
                'receivedActions',
                'knowledge',
            ])
            ->whereHas('knowledge', function ($query) {
                $this->loggedUser->interests->each(function (Interest $interest, $key) use ($query) {
                    $query->when($key === 0, function ($query) use ($interest) {
                        $query->where('skill_id', $interest->skill_id)
                            ->where('level', '>=', $interest->level);
                    }, function ($query) use ($interest) {
                        $query->orWhere('skill_id', $interest->skill_id)
                            ->where('level', '>=', $interest->level);
                    });
                });
            })
            ->whereDoesntHave('receivedActions', function ($query) {
                $query->where('from_user_id', $this->loggedUser->id)
                    ->where('expiration_at', '>=', now());
            })
            ->where('id', '<>', $this->loggedUser->id)
            ->paginate(perPage: 5, page: $page)
            ->toArray();

        $this->developers = Arr::only($this->developers, ['current_page', 'data', 'last_page', 'total']);
    }

    public function render(): Factory|View
    {
        return view('livewire.components.developers-screen');
    }
}
