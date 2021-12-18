<?php

declare(strict_types=1);

namespace App\Http\Livewire\Components;

use App\Models\Action;
use App\Models\Message;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatList extends Component
{
    public mixed $loggedUser;

    public array $receivedActions;

    public array $receivedMessages;

    public function mount(): void
    {
        $this->loggedUser = User::with('profile', 'interests', 'knowledge', 'sentActions')
            ->find(Auth::user()->id);

        $this->getData();
    }

    public function getData() {
        $sentActions = $this->loggedUser->sentActions
            ->pluck('to_user_id')
            ->toArray();

        $sentDislikes = $this->loggedUser->sentActions
            ->where('name', 'DISLIKE')
            ->pluck('to_user_id')
            ->toArray();

        $this->receivedActions = Action::with('fromUser.profile')
            ->where('to_user_id', $this->loggedUser->id)
            ->where('name', 'LIKE')
            ->whereNotIn('from_user_id', $sentActions)
            ->get()
            ->toArray();

        $this->receivedMessages = Action::with('fromUser.profile')
            ->where('to_user_id', $this->loggedUser->id)
            ->whereIn('name', ['LIKE', 'SUPERLIKE'])
            ->whereIn('from_user_id', $sentActions)
            ->whereNotIn('from_user_id', $sentDislikes)
            ->get()
            ->toArray();

    }

    public function action(int $toUserId, string $actionName): void
    {
        Action::updateOrCreate([
            'from_user_id' => $this->loggedUser->id,
            'to_user_id' => $toUserId,
            'name' => $actionName,
            'expiration_at' => now()->addDays(15),
        ]);

        $this->mount();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.components.chat-list');
    }
}
