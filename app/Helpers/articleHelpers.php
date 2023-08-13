<?php

use App\UserProfiles;
use App\Articles;
use Illuminate\Support\Facades\Auth;

function get_user_role(){
    $userProfile = UserProfiles::where('user_id', Auth::user()->id)->first();
    return $userProfile->role;
}

function get_article_ids(){
    $role = get_user_role();
    if($role=='writer'){
        $articleID = Articles::where('creator_id', Auth::user()->id)->pluck('article_id');
    }
    else{   //editor
        $articleID = Articles::pluck('article_id');
    }
    return $articleID;
}
