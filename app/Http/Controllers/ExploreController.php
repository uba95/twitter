<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index() {

        $users = User::paginate(3);
        return view('explore', compact('users'));
    }
}
