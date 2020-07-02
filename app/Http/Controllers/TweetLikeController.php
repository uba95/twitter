<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Notifications\LikeNotifacation;
use Illuminate\Http\Request;
use App\Http\Requests;

class TweetLikeController extends Controller
{
    public function store(Tweet $tweet, Request $request) {
        $liked = json_decode($request['liked']);
        $liked ? $tweet->like(current_user()) : $tweet->dislike(current_user());
        $tweet = Tweet::where('id', $tweet->id)->WithLikes()->first();
        $html = view('components.like-buttons', compact('tweet'))->render();
        return response()->json(compact('html'));
    }
}
