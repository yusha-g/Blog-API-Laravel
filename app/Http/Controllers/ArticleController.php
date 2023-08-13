<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Users;
use App\UserProfiles;
use App\Articles;
use App\Http\Middleware\CheckUserStatus;


class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware(CheckUserStatus::class);
    }

    public function check_article_access(Request $req){
        $articleID = get_article_ids();
        return response()->json([
            "Accessible Articles"=> $articleID
        ]);
    }

    public function create_article(Request $req){
        $role = get_user_role();
        if($role == 'writer'){
            $validatedData = $req->validate([
                'title' => 'required|max:100|min:1',
                'post' => 'required|max:65535|min:1'
            ]);
            $article = Articles::create([
                'creator_id'=> Auth::user()->id,
                'title'=>$validatedData['title'],
                'post'=>$validatedData['post']
            ]);
            return response()->json([
                "message"=>"Successfully Created Article",
                "article_id"=>$article->article_id
            ]);
        }
        else{
            return response()->json([
                "message"=>"User is not a Writer"
            ],401);
        }
    }

    public function read_article(Request $req, $article_id){
        /**
         * without toArray()
         * "in_array() expects parameter 2 to be array, object given"
         * look into it
         */
        $articleIDs = get_article_ids();
        if(in_array($article_id, $articleIDs->toArray())){
            $article = Articles::find($article_id);
            return response()->json([
                'title' => $article->title,
                'post' => $article->post,
            ]);
        }
        else{
            return response()->json([
                "message"=>"Cannot Access Article",
                "Accessible Articles"=>$articleIDs
            ],401);
        }
    }

    public function update_article(Request $req, $article_id){
        $validatedData = $req -> validate([
            'title' => 'required|max:100|min:1',
            'post' => 'required|max:65535|min:1'
        ]);
        $articleIDs = get_article_ids();
        $role=get_user_role();
        if(
            in_array($article_id, $articleIDs->toArray()) &&
            $role == 'writer'
        ){
            /* ALTERNATE:
            $article = Articles::where('article_id', $article_id)
            ->where('creator_id', Auth::user()->id)
            ->first();
            */
            $article = Articles::where('article_id',$article_id)->first();
            $article -> update([
                'title'=>$validatedData['title'],
                'post'=>$validatedData['post']
            ]);
            return response()->json([
                "message"=>"Successfully Updated",
                'title'=>$article['title'],
                'post'=>$article['post']
            ],200);
        }
        else{
            return response()->json([
                "message"=>"Cannot Access Article",
                "role"=>$role,
                "Accessible Articles"=>$articleIDs
            ],401);
        }
    }

    public function delete_article(Request $req, $article_id){
        $articleIDs = get_article_ids();
        $role=get_user_role();
        if(
            in_array($article_id, $articleIDs->toArray()) &&
            $role == 'writer'
        ){
            /* ALTERNATE:
            $article = Articles::where('article_id', $article_id)
            ->where('creator_id', Auth::user()->id)
            ->first();
            */
            $article = Articles::where('article_id',$article_id)->first();
            $article -> delete();
            return response()->json([
                "message"=>"Successfully Deleted Article",
                'id'=>$article_id
            ],200);
        }
        else{
            return response()->json([
                "message"=>"Cannot Access Article",
                "role"=>$role,
                "Accessible Articles"=>$articleIDs
            ],401);
        }
    }


}
