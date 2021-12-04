<?php

declare(strict_types=1);

namespace App\Http\Livewire\Components;

use App\Events\ChatStatusUpdated;
use App\Events\PrivateEvent;
use App\Models\Action;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    public $loggedUser;

    public $receivedMessages;

    public $chatUser;

    public $listeners = ['sendMessage'];

    public function sendMessage(string $message): void
    {
        $sentMessage = Message::create([
            'from_user_id' => $this->loggedUser['id'],
            'to_user_id' => $this->chatUser['id'],
            'content' => $message,
        ]);

//        ChatStatusUpdated::dispatch($sentMessage);
        PrivateEvent::dispatch($sentMessage);
    }

    private function hasMatch(): bool
    {
        $actions = Action::where('from_user_id', $this->loggedUser['id'])
            ->where('to_user_id', $this->chatUser['id'])
            ->orWhere('from_user_id', $this->chatUser['id'])
            ->where('to_user_id', $this->loggedUser['id'])
            ->where('name', '<>', 'DISLIKE')
            ->get();

        $hasSuperLike = $actions->contains(fn ($value) => $value->name === 'SUPERLIKE');

        return $hasSuperLike || $actions->count() >= 2;
    }

    public function mount(User $user) {
        $this->loggedUser = User::with('profile', 'interests', 'knowledge', 'sentActions')
            ->find(Auth::user()->id)
            ->toArray();

        $this->chatUser = $user->load('profile')->toArray();

        if (!$this->hasMatch()) {
            return redirect()->route('app.chat-list');
        }

        $this->receivedMessages = Message::where('from_user_id', $this->chatUser['id'])
            ->where('to_user_id', $this->loggedUser['id'])
            ->orWhere('from_user_id', $this->loggedUser['id'])
            ->where('to_user_id', $this->chatUser['id'])
            ->orderBy('id', 'asc')
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.components.chat');
    }
}
