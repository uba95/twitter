<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'password','avatar', 'cover', 'bio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function tweets() {

        return $this->hasMany(Tweet::class);
    }

    public function likes() {

        return $this->hasMany(Like::class);
    }

    public function timeline() {

        $timeline = $this->follows()->pluck('id')->push($this->id);
        
        return Tweet::whereIn('user_id', $timeline)->WithLikes()->with('user', 'likes')->latest()->paginate(5);
        // return User::whereIn('id', $timeline)->with('tweets')->latest()->get();

    }

    public function user_tweets() {

        
        return $this->tweets()->WithLikes()->with('user', 'likes')->latest()->paginate(3);

    }

    
    public function getAvatarAttribute($value) {

        // return 'https://i.pravatar.cc/40?u=' . $this->id;

        return asset($value ? 'storage/'. $value : '/images/default-user-profile.png');
    }

    public function getCoverAttribute($value) {

        return asset($value ? 'storage/'. $value : '/images/default-profile-cover.svg');
    }

    public function setPasswordAttribute($value) {

        if(Hash::needsRehash($value)) {
            $value = Hash::make($value);
        }
        $this->attributes['password'] = $value;
    }

    public function routeNotificationForNexmo($notification)
    {
        return '+970597344722';
    }

    // public function getRouteKeyName() {
    
    //     return 'name';
    // }
}
