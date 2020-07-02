<?php
namespace App\Models;

use App\Notifications\LikeNotifacation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Schema\Builder as SchemaBuilder;

trait Likeable {

    public function likes() {

        return $this->hasMany(Like::class);
    }

    public function like($user = null , $liked = true) {

        if ($this->isLikedBy($user)) {
            
            return $this->likes()->where('user_id', $user->id)->delete() ; 

        } else {

            $liked? $this->user->notify(new LikeNotifacation($user)) : '';
            $user_id = $user ? $user->id : auth()->id();
            return $this->likes()->where('user_id', $user->id)->updateOrCreate(compact('user_id'), compact('liked'));
        }

    }
    
    public function dislike($user = null, $liked = false) {

        // return $this->like($user, false);
        $user_id = $user ? $user->id : auth()->id();

        if ($this->isDisLikedBy($user)) {
            return $this->likes()->where('user_id', $user->id)->delete() ; 
        }

        return $this->likes()->updateOrCreate(compact('user_id'), compact('liked'));

    }

    public function isLikedBy(User $user) {

        // return ($user->likes->pluck('tweet_id')->contains($this->id) && $user->likes->pluck('liked')->contains(true)) ? true : false ;
        // $ar = $user->likes->where('tweet_id', $this->id)->where('liked', true)->all();
        // return !empty($ar) ? true : false;
        // return Like::where('tweet_id', $this->id)->where('user_id', $user->id)->where('liked', true)->with('user', 'tweet')->exists();
        return $this->likes->where('user_id', $user->id)->where('liked', true)->isNotEmpty();
    }

    public function isDisLikedBy(User $user) {

        // return ($user->likes->pluck('tweet_id')->contains($this->id) && $user->likes->pluck('liked')->contains(false)) ? true : false ;
        // $ar = $user->likes->where('tweet_id', $this->id)->where('liked', false)->all();
        // return !empty($ar) ? true : false;
        return $this->likes->where('user_id', $user->id)->where('liked', false)->isNotEmpty();
    }

    public function scopeWithLikes(Builder $query) {

        $query->leftJoinSub(

            'SELECT tweet_id, SUM(liked) likes_sum , SUM(!liked) dislikes_sum FROM likes GROUP By tweet_id',
            'likes', 'likes.tweet_id', 'tweets.id'
        );
    }

}