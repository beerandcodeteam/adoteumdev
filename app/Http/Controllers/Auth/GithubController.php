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

class GithubController extends Controller
{
    const NAME = 'GITHUB';

    protected User $authUser;

    public function __invoke(): RedirectResponse
    {
        try {
            $user = Socialite::driver('github')->user();

            DB::transaction(function() use($user) {
                $this->authUser = User::updateOrCreate([
                    'email' => $user->email,
                ], [
                    'name' => $user->name,
                    'password' => Hash::make(Str::random(7)),
                ])->load('interest', 'preference');

                Profile::updateOrCreate([
                    'user_id' => $this->authUser->id,
                ], [
                    'provider' => self::NAME,
                    'provider_user_id' => $user->id,
                    'nickname' => $user->nickname,
                    'avatar' => $user->avatar,
                    'data' => json_encode($user->user),
                ]);
            }, 3);

            Auth::login($this->authUser);

            if (is_null($this->authUser->interest)) {
                return redirect()->route('app.interest');
            }

            if (is_null($this->authUser->preference)) {
                return redirect()->route('app.preference');
            }

            return redirect()->route('app.developers');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
        }
    }
}
