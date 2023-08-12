<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $primaryKey = 'comment_id';
    protected $fillable = [
        'article_id', 'creator_id','content'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
