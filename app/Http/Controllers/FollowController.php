<?php

namespace App\Http\Controllers;

use App\Models\FirebaseTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{

    use FirebaseTrait;
    
    public function store(User $user, Request $request) {

        $styleClass = $request['styleClass'];
        $username = $user->name;
        current_user()->toggleFollow($user);
        $html = view('components.follow-button', compact('user', 'styleClass'))->render();

        current_user()->isFollowing($user) ? $this->sendPush($request) : '';
        return response()->json(compact('html', 'username'));
    }

}
