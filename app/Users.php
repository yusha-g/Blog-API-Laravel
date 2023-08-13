<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = [
        'email', 'password','phone',
    ];
    //foreign, primary  
    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }
    public function articles()
    {
        return $this->hasMany(Articles::class, 'creator_id','id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'creator_id', 'id'); 
    }
}
