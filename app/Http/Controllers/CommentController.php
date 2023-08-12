<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create_comment(Request $req){
        if(Auth::check()){
            return "A";
        }
        else{
            return response()->json([
                "message"=>"User not Logged In!"
            ]);
        }
    }

    public function read_comments(Request $req){
        if(Auth::check()){
            return "A";
        }
        else{
            return response()->json([
                "message"=>"User not Logged In!"
            ]);
        }
    }
}
