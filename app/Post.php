<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = [
        'user_id', 'title','address','rent','approve'
    ];

     public function images(){
        return $this->hasMany(Image::class);
    }
    public function user(){
    	return $this->belongsTo(User::class);
    }
     
}
