<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    protected $guarded = [];

    public function user() {

        return $this->belongsTo(User::class);
    }

    public function tweet() {

        return $this->belongsTo(Tweet::class);
    }

}
