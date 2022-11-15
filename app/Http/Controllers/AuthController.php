<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' =>'required|string'
         ]);
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt( $fields['password'])
         ]);
        $token = $user->createToken('devop')->plainTextToken;
        $response = [ 
            'user' => $user , 
            'token' => $token  
        ];
        return  response($response, 201);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email' ,$request->email)->with('roles.permissions')->first();
        if(!$user || !Hash::check($request->password , $user->password)){
            return response([
                'message' => ' Bad creds'
            ], 401);
        }
        $token = $user->createToken('devop')->plainTextToken;
        $response = [ 
            'user' =>$user , 
            'token' =>$token  
        ];
        return  response($response, 201);
    }

    public function logout(Request $request){
      auth()->user()->tokens()->delete();
      return response([
        'message' =>'Logged Out',
      ],200);
    }
    
    public function get(){
        $user = User::with('roles.permissions')->get();
        return  response($user, 200);
    }
}   