<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $guarded = [];

    public function user() {

        return $this->belongsTo(User::class);
    }

    public function tweet() {

        return $this->belongsTo(Tweet::class);
    }

}
