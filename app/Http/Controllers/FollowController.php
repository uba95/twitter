<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store(User $user, Request $request) {

        $style = $request['style'];
        $username = $user->name;
        auth()->user()->toggleFollow($user);
        $html = view('components.follow-button', compact('user', 'style'))->render();
        return response()->json(compact('html', 'username'));
    }
}
