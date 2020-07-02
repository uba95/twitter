<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use Likeable;

    protected $guarded = [];

    public function user() {

        return $this->belongsTo(User::class);
    }
    
    public function likes() {

        return $this->hasMany(Like::class);
    }

    public function tweetDate() {

        return $this->created_at->diffForHumans(['options' => Carbon::JUST_NOW | Carbon::ONE_DAY_WORDS]);
    }
}
