<?php

declare(strict_types=1);

namespace App\Http\Livewire\Components;

use App\Models\Action;
use App\Models\Knowledge;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DevelopersScreen extends Component
{
    public mixed $loggedUser;
    public Collection $developers;

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

        $this->developers = User::select('id', 'name')
            ->with('profile', 'knowledge', 'receivedActions')
            ->whereHas('knowledge', function ($query) {
                // $this->loggedUser->interests; // todos os interesses do recrutador (Collection)

                $query->whereIn('skill_id', $this->loggedUser->interests->pluck('skill_id')->toArray());
                // não exibir developers (User) onde o knowledge.level < 3  $this->loggedUser->interests[x].level

                // >= 3 estrelas dos "interests" do recrutador
            })
            ->whereDoesntHave('receivedActions', function ($query) {
                $query->whereNotIn('name', ['like', 'superlike']);
            })
            ->where('id', '<>', $this->loggedUser->id) // adicionado essa cláusula, pois não posso listar a mim mesmo
            ->get(); // paginate(5)



        dd($this->developers);

        //$developers->commonInterests = ['PHP', 'Laravel', 'Inglês'] (listagem agrupara do $this->developers->knowledge)


        //dd($this->loggedUser->interests->forget(0));
    }

    public function render(): Factory|View
    {
        return view('livewire.components.developers-screen');
    }
}
