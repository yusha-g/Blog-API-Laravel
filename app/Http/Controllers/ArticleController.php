<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Users;
use App\UserProfiles;
use App\Articles;

class ArticleController extends Controller
{

    private function get_user_role(){
        $userProfile = UserProfiles::where('user_id', Auth::user()->id)->first();
        return $userProfile->role;
    }

    public function view_article(Request $req){
        if(Auth::check()){
            $role = ArticleController::get_user_role();
            if($role=='writer'){
                $articleID = Articles::where('creator_id', Auth::user()->id)->pluck('article_id');
            }
            else{   //editor
                $articleID = Articles::pluck('article_id');
            }
            return response()->json([
                "Accessible Articles"=> $articleID
            ]);
        }
        else{
            return response()->json([
                "message"=>"User Not Logged In"
            ],401);
        }
    }

    public function create_article(Request $req){
        if(Auth::check()){
            $role = ArticleController::get_user_role();
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
        else{
            return response()->json([
                "message"=>"User Not Logged In"
            ],401);
        }
    }

    public function read_article(Request $req, $article_id){
        if(Auth::check()){
            return $article_id;
        }
        else{
            return response()->json([
                "message"=>"User Not Logged In"
            ],401);
        }
    }

    public function update_article(Request $req, $article_id){
        if(Auth::check()){
            return "A";
        }
        else{
            return response()->json([
                "message"=>"User Not Logged In"
            ],401);
        }
    }

    public function delete_article(Request $req, $article_id){
        if(Auth::check()){
            return "A";
        }
        else{
            return response()->json([
                "message"=>"User Not Logged In"
            ],401);
        }
    }


}
