<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Core\Component;

class Verify extends Component
{
    public function resend(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            redirect(route('home'));
        }

        Auth::user()->sendEmailVerificationNotification();

        $this->emit('resent');

        session()->flash('resent');
    }

    public function render()
    {
        return view('livewire.auth.verify')->extends('layouts.auth');
    }
}
