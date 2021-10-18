<?php

namespace App\Http\Livewire\Auth\Passwords;

use App\Http\Livewire\Core\Component;

class Confirm extends Component
{
    public string $password = '';

    public function confirm(): \Illuminate\Http\RedirectResponse
    {
        $this->validate([
            'password' => 'required|password',
        ]);

        session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.passwords.confirm')->extends('layouts.auth');
    }
}
