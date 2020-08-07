<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store(User $user, Request $request) {

        $styleClass = $request['styleClass'];
        $username = $user->name;
        auth()->user()->toggleFollow($user);
        $html = view('components.follow-button', compact('user', 'styleClass'))->render();
        return response()->json(compact('html', 'username'));
    }
}
