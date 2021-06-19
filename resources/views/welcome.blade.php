@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen w-full bg-gradient-to-tr from-primary-100 to-secondary-100">
        <div class="flex flex-col items-center justify-center space-y-2">
            <img class="w-14 h-14" src="{{ asset('assets/logo-adote-um-dev-white.svg') }}" />
            <span class="text-white font-bold">AdoteUm.Dev</span>
        </div>
    </div>
@endsection
