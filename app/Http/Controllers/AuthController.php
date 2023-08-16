<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Users;
use App\UserProfiles;

class AuthController extends Controller
{

    public function register_view(){
        return view('auth.register');
    }


    public function register(Request $req){
        try{
            #VALIDATE REQUEST

            $validatedData = $req->validate([
                'email' => 'required|email',
                "phone" => 'required|numeric|digits:10',
                "password" => 'required|min:8',
                "confirm-password" => 'required|same:password'
            ]);
            
            #CREATE USER WITH VALIDATED CREDENTIALS
            $user = Users::create([
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'password' => bcrypt($validatedData['password'])
            ]);
            
            #CREATE USER PROFILE
            $userProfiles = UserProfiles::create([
                //everything else is null by default. except roll = writer
                'user_id'=>$user->id,
                'first_name'=>explode("@", $user->email)[0]
            ]);

            return response()->json(
                [
                    'message'=>'User Successfully Registered!',
                    'user'=>$user->id
                ],200
            );

        } catch(Exception $e){
            return response()->json(
                [
                    'message' => 'Could Not Register', 
                    'errors' => $e->errors()
                ], 422
            );
        }
    }


    public function login_view(){
        return view('auth.login');
    }

    public function login(Request $req){
                dd($req->all());
                return view('profile');
        
    }

    public function logout(Request $req){
        try{
            Auth::logout();
            $req->session()->invalidate();
            return response()->json([
                'message'=> "Successfully Logged Out"
            ], 200);

        } catch (Expection $e){
            return response()->json([
                'error'=> $e->errors()
            ]);
        }
    }
}
