<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class SocialController extends Controller
{
    public function redirect($service) {

        return Socialite::driver($service)->stateless()->redirect();
    }

    public function callback($service)
    {
    $user = Socialite::driver($service)->stateless()->user() ;
    return response()->json($user);
    }
}
