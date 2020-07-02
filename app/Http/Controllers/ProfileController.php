<?php

namespace App\Http\Controllers;

use App\Models\User;
use Redirect;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\UpdateProfile;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $tweets = $user->user_tweets();
        return view('profiles.show', compact('user', 'tweets'));
    }

    public function edit(User $user)
    {
        // abort_if($user->isNot(current_user()), 403);
        // $this->authorize('edit', $user);
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user, UpdateProfile $request)
    {
        // $attributes =  request()->validate([
            
        //     'username' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('users')->ignore($user)],
        //     'name' => ['required', 'string', 'max:255'],
        //     'avatar' => ['image', 'max:4096'],
        //     'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
        //     'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        // ], $messages = [

        //     'avatar.max' => 'The avatar may not be greater than 4MB.'
        // ]);
        $attributes = $request->validated();

        if( request('avatar')) {
            
            $attributes['avatar'] = request('avatar')->store('avatars');
        }

        $user->update($attributes);
        return redirect(route('profile', $user));
    }

}
