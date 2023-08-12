<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\UserProfiles;

class ProfileController extends Controller
{
    public function view_profile(Request $req){
        if(Auth::check()){
            $userProfile = UserProfiles::where('user_id', Auth::user()->id)->first();
            return response()->json([
                "first name"=>$userProfile->first_name,
                "last name"=>$userProfile->last_name,
                "role"=>$userProfile->role
            ],200);
        }
        else{
            return response()->json([
                "message"=>"User Not Logged In"
            ],401);
        }
    }

    public function edit_profile(Request $req){
        if(Auth::check()){
            $userProfile = UserProfiles::where('user_id', Auth::user()->id)->first();
            
            $validatedData = $req->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'role' => 'required|string|in:editor,writer'
            ]);
            
            $userProfile -> update([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'role' => $validatedData['role']
            ]);

            return response()->json([
                'first_name' => $userProfile->first_name,
                'last_name' => $userProfile->last_name,
                'role' => $userProfile->role,
            ]);
        }
        else{
            return response()->json([
                "message"=>"User Not Logged In"
            ],401);
        }
    }
}
