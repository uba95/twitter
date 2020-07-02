<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CoverController extends Controller
{
    public function __invoke(User $user) {

        $attributes =  request()->validate(['cover' => ['required', 'image']]);
        
        if( request('cover')) {
            
            $attributes['cover'] = request('cover')->store('covers');
        }

        $user->update($attributes);
        return redirect(route('profile', $user));
    }



    
}
