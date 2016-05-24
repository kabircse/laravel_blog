<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment_reply extends Model
{
    protected $fillable = ['comment_id','is_active','author','email','body','photo_id'];

    public function comment(){
      return $this->belongsTo('App\Comment');
    }
}
