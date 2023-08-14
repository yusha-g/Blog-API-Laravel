<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Comments;
use App\Articles;
use App\Http\Middleware\CheckUserStatus;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(CheckUserStatus::class);
    }

    public function create_comment(Request $req, $article_id){
        $validatedData = $req->validate([
            "content"=>"required|min:1|max:500"
        ]);

        $articleIDs = get_article_ids(); 
        if(in_array($article_id,$articleIDs->toArray())){
            $comment = Comments::create([
                'creator_id'=> Auth::user()->id,
                'article_id'=>$article_id,
                'content'=>$validatedData['content']
            ]);
            return response()->json([
                "message"=>"Successfully Created Article",
                "article_id"=>$comment->comment_id
            ]);
        }
        else{
            return response()->json([
                "message"=>"Cannot Access Article",
                "Accessible Articles"=>$articleIDs
            ],401);
        }
    }

    public function read_comments(Request $req, $article_id){
        $articleIDs = get_article_ids(); 
        if(in_array($article_id,$articleIDs->toArray())){

            $comment = Comments::select('comment_id','content','created_at','updated_at')
            ->where('article_id', $article_id)
            ->where('creator_id', Auth::user()->id)
            ->get();

            return $comment;
        }
        else{
            return response()->json([
                "message"=>"Cannot Access Article",
                "Accessible Articles"=>$articleIDs
            ],401);
        }
    }

    public function delete_comment(Request $req, $article_id,$comment_id){
        $articleIDs = get_article_ids();
        if(in_array($article_id,$articleIDs->toArray())){
            $comment = Comments::where('comment_id',$comment_id)
            ->where('creator_id',Auth::user()->id)
            ->first();
            if($comment){
                $comment -> delete();
                return response()->json([
                    "message"=>"Successfully Deleted Comment",
                    "id"=>$comment_id
                ]);
            }
            else{
                return response()->json([
                    "message"=>"Connot Deleted Comment",
                    'id'=>$comment_id
                ],401);
            }
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
