<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfiles extends Model
{
    protected $primaryKey = 'profile_id';
    protected $fillable = [
        'user_id', 'first_name','last_name','role'
    ];

    public function user()
    {
        return $this->belongsTo(Users::class,'user_id');
    }
}
