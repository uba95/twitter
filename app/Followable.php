<?php 
namespace App;

use App\Notifications\FollowNotifacation;

trait Followable {

    public function follows() {

        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id')->withTimestamps();
    }

    public function followers() {

        return $this->belongsToMany(User::class, 'follows', 'following_user_id', 'user_id')->withTimestamps();
    }

    public function follow(User $user) {

        $user->notify(new FollowNotifacation($this));
        return $this->follows()->syncWithoutDetaching($user);
    }

    public function unfollow(User $user) {

        return $this->follows()->detach($user);
    }

    public function isFollowing(User $user) {

        // return $this->follows()->where('following_user_id', $user->id)->exists();
        return $this->follows->pluck('id')->contains($user->id);
    }

    public function toggleFollow(User $user) {
        
        $this->follows()->toggle($user);

        if ($this->isFollowing($user)) {

            $user->notify(new FollowNotifacation($this));
        } 

    }

}