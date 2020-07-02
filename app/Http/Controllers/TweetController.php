<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TweetController extends Controller
{
    public function index()
    {

        return view('tweets.index', [

            'tweets' => auth()->user()->timeline()
        ]);
    }

    public function store() {

        $attributes = request()->validate([

            'body' => 'required|max:255'
        ], $messages = [
            'body.required' => 'The Tweet Can not Be Empty',
        ]);
        

        Tweet::create([

            'user_id' => auth()->id(),
            'body' => request('body')
        ]);

        $tweets = current_user()->timeline();
        $html = view('_timeline', compact('tweets'))->render();
        return response()->json(compact('html'));
    }

    public function destroy(Tweet $tweet) {

        $tweet->delete();
    }
}