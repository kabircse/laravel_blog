<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['file'];
    protected $uploads = '/uploads/images/profile_picture/';

    public function getFileAttribute($photo){
        return $this->uploads.$photo;
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
