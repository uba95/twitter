<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class SocialController extends Controller
{
    public function redirect($service) {

        return Socialite::driver($service)->stateless()->redirect();
    }

    public function callback($service)
    {
    $user = Socialite::driver($service)->stateless()->user();
    $finduser = User::where('facebook_id', $user->getId())->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/home');
            } else {
                $newUser = User::create([
                    'username' => strtolower(str_replace(" ", "", $user->getName() . rand(0,1000000000))),
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'facebook_id' => $user->getId(),
                    'avatar' => $user->getAvatar(),
                    ]);
                Auth::login($newUser);
                $newUser->sendEmailVerificationNotification();
                return redirect('/home');
            }
    }
}

