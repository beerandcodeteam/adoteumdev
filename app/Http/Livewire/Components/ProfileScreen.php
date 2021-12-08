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

    public function uploadAvatar(): void
    {
        $this->validate([
            'imageProfile' => 'image',
        ]);
        $path = $this->imageProfile->store('avatarProfile', 'public');
        $profile = Profile::find($this->loggedUser['profile']['id']);
        $profile->avatar = url("storage/{$path}");
        $profile->save();
        $this->imageProfile = $profile->avatar;
    }

    public function mount(User $user)
    {
        $this->loggedUser = User::with('profile')
            ->find(Auth::user()->id)?->toArray();
    }

    public function render()
    {
        return view('livewire.components.profile-screen');
    }
}
