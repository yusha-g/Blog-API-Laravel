<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $primaryKey = 'article_id';
    protected $fillable = [
        'creator_id', 'title','post'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'article_id', 'article_id');
    }
}
