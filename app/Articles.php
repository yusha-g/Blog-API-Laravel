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
}
