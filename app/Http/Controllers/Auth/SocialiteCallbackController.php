<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteCallbackController extends Controller
{
    public function __invoke(string $driver): RedirectResponse
    {
        try {
            $socialiteUser = Socialite::driver($driver)->user();

            $newUser = DB::transaction(function () use ($socialiteUser, $driver) {
                $user = User::updateOrCreate([
                    'email' => $socialiteUser->email,
                ], [
                    'name' => $socialiteUser->name ?? $socialiteUser->nickname,
                    'password' => Hash::make(Str::random(7)),
                ])->load('interest', 'preference');

                Profile::updateOrCreate([
                    'user_id' => $user->id,
                ], [
                    'provider' => strtoupper($driver),
                    'provider_user_id' => $socialiteUser->id,
                    'nickname' => $socialiteUser->nickname,
                    'avatar' => $socialiteUser->avatar,
                    'data' => json_encode($socialiteUser->user),
                ]);

                return $user;
            }, 3);

            Auth::login($newUser);

            if (is_null($newUser->interest)) {
                return redirect()->route('app.interest');
            }

            if (is_null($newUser->preference)) {
                return redirect()->route('app.preference');
            }

            return redirect()->route('app.developers');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
        }
    }
}
