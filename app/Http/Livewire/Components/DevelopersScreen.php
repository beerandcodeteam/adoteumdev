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
use Illuminate\Support\Str;
use Livewire\Component;

class DevelopersScreen extends Component
{
    public mixed $loggedUser;

    public mixed $developers;

    public function action(int $toUserId, string $actionName): void
    {
        Action::updateOrCreate([
            'from_user_id' => $this->loggedUser->id,
            'to_user_id' => $toUserId,
            'name' => $actionName,
            'expiration_at' => now()->addDays(15),
        ]);

        if (Str::upper($actionName) === "SUPERLIKE") {
            Action::updateOrCreate([
                'from_user_id' => $toUserId,
                'to_user_id' => $this->loggedUser->id,
                'name' => $actionName,
                'expiration_at' => now()->addDays(15),
            ]);
        }
    }

    public function mount(): void
    {
        $this->loggedUser = User::with('profile', 'interests', 'knowledge', 'sentActions')
            ->find(Auth::user()->id);

        $this->getDevelopers();
    }

    public function getDevelopers(int $page = 1): void
    {
        $this->developers = User::select('id', 'name')
            ->with([
                'profile',
                'receivedActions',
                'knowledge.skill',
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
            ->paginate(perPage: 5, page: $page);

        $devs = collect($this->developers->items());
        $devs->map(function ($dev) {
            $dev->stack = "";
            $dev->commonknolowdge = "";

            $programingLang = $dev->knowledge
                ->filter(function($knowledge) {
                    return $knowledge->skill->category_id === 1;
                })
                ->sortByDesc('level')
                ->first();

            $framework = $dev->knowledge
                ->filter(function($knowledge) {
                    return $knowledge->skill->category_id === 2;
                })
                ->sortByDesc('level')
                ->first();

            if ($programingLang) {
                $dev->stack .= $programingLang->skill->name;
            }

            if ($framework) {
                $dev->stack .= " {$framework->skill->name}";
            }

            $dev->stack .= " Developer";

            $commonknolowdge = $dev->knowledge->filter(function ($knowledge) {
                return $this->loggedUser->interests->where('skill_id', $knowledge->skill_id)->first();
            });

            $dev->commonknolowdge = "{$commonknolowdge->count()} interesses em comum [{$commonknolowdge->pluck('skill.name')->implode(', ')}]";

        });

        $this->developers = $this->developers->toArray();
        $this->developers['data'] = $devs->toArray();

        $this->developers = Arr::only($this->developers, ['current_page', 'data', 'last_page', 'total']);
    }

    public function render(): Factory|View
    {
        return view('livewire.components.developers-screen');
    }
}
