<?php

namespace App\Http\Livewire\Components;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileScreen extends Component
{
    use WithFileUploads;

    public array $loggedUser;
    public $imageProfile;

    public function uploadAvatar()
    {
        $this->validate([
            'imageProfile' => 'image',
        ]);
        $this->imageProfile->store('avatarProfile');

        $profile = Profile::find($this->loggedUser['profile']['id']);
        $profile->update([
            'avatar' => $this->imageProfile->temporaryUrl()
        ]);
    }

    public function mount(User $user)
    {
        $this->loggedUser = User::with('profile', 'interests', 'knowledge', 'sentActions')
            ->find(Auth::user()->id)?->toArray();
    }

    public function render()
    {
        return view('livewire.components.profile-screen');
    }
}
