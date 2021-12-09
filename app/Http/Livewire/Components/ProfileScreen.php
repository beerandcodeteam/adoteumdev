<?php

namespace App\Http\Livewire\Components;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileScreen extends Component
{
    use WithFileUploads;

    public array $loggedUser;
    public mixed $imageProfile = '';

    public function uploadAvatar(): void
    {
        $this->validate([
            'imageProfile' => 'image',
        ]);
        $this->storeAvatar();
    }

    public function storeAvatar(): bool
    {
//        TODO: validar local de upload.
//        TODO: Cada vez que faz login, atualiza a imagem com a do github.
        $nameAvatar = "avatar{$this->loggedUser['id']}.{$this->imageProfile->extension()}";
        $path = $this->imageProfile->storeAs(
            'avatarProfile',
            $nameAvatar,
            'public'
        );
        $profile = Profile::find($this->loggedUser['profile']['id']);
        $profile->avatar = url("storage/{$path}");

        if ($profile->save()) {
            $this->imageProfile = null;
            $this->loggedUser['profile']['avatar'] = $profile->avatar;
            return true;
        }

        return false;
    }

    public function mount(User $user): void
    {
        $this->loggedUser = User::with('profile')
            ->find(Auth::user()->id)?->toArray();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.components.profile-screen');
    }
}
