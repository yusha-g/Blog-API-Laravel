<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\UserProfiles;
use App\Http\Middleware\CheckUserStatus;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(CheckUserStatus::class);
    }

    public function view_profile(Request $req){
        $userProfile = UserProfiles::where('user_id', Auth::user()->id)->first();
            return response()->json([
                "first name"=>$userProfile->first_name,
                "last name"=>$userProfile->last_name,
                "role"=>$userProfile->role
            ],200);
    }

    public function edit_profile(Request $req){
        $userProfile = UserProfiles::where('user_id', Auth::user()->id)->first();
            $customMessages = [
                'role.in' => 'The selected role is invalid [editor/writer]',
            ];
            $validatedData = $req->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'role' => 'required|string|in:editor,writer'
            ],$customMessages);
            
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
}
