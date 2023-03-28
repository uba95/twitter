<?php
namespace App\Models;

use App\Events\LikeEvent;
use App\Jobs\LikeNotifacationJob;
use App\Notifications\LikeNotifacation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Schema\Builder as SchemaBuilder;

trait Likeable {

    public function likes() {

        return $this->hasMany(Like::class);
    }

    public function like($user = null , $liked = true) {

        $user_id = $user ? $user->id : auth()->id();

        if ($liked && $this->isLikedBy($user) || !$liked && $this->isDisLikedBy($user)) {
            
            return $this->likes()->where('user_id', $user_id)->delete() ; 
        } 
        $this->likes()->updateOrCreate(compact('user_id'), compact('liked'));

        // from $user to $this->user 
        $liked ? LikeNotifacationJob::dispatch($this->user) : '';

    }
    
    public function dislike($user = null, $liked = false) {

        return $this->like($user, $liked);

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