<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function __invoke(User $user) {

        // $fUser = User::where('id', $user->id)->with('follows', 'followers')->get();
        $fUser = $user;
        return view('_friends-list', compact('fUser'));
    }
}
