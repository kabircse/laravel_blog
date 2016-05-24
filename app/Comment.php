<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $fillable = ['post_id', 'is_active', 'author','email','body','photo_id'];

    public function replies(){
        return $this->hasMany('App\Comment_reply');
    }
}
