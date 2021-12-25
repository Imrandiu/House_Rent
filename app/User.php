<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable 
{
    use Notifiable;


    protected $fillable = [
        'name', 'email','phone_no','address','post_code','nid_no', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function posts(){
        return $this->hasMany(Post::class);
    }

}

