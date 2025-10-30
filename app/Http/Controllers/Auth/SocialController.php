<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();

        $user = User::firstOrCreate(
            ['provider' => $provider, 'provider_id' => $socialUser->getId()],
            [
                'email' => $socialUser->getEmail() ?: Str::lower($provider).'_user_'.$socialUser->getId().'@example.com',
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'avatar' => $socialUser->getAvatar(),
                'password' => null,
            ]
        );

        Auth::login($user, true);
        return redirect()->route('home');
    }
}
