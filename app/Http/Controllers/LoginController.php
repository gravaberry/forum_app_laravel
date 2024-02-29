<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginrequest;
use App\Models\User;
use App\Http\Requests\registerloginrequest;
use Illuminate\Http\request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function register(registerloginrequest $request)
    {
        $request->validated();

        $userData = [
            'name'=> $request->name,
                'username'=>$request->username,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
        ];
        $user=User::create($userData);
         $token = $user->createToken('rahasia')->plainTextToken;
         return response([
            'user'=>$user,
            'token'=>$token
         ],200);

    }

    public function login(loginrequest $request)
    {
        $request->validated();

        $user = User::whereUsername($request->username)->first();
        if(!$user || !Hash::check($request->password, $user->password))
        {
            return response([
                'message'=>'Invalid Credentials'
            ],200);
        }
        $token = $user->createToken('rahasia')->plainTextToken;
        return response([
            'user'=>$user,
            'token'=>$token,
        ],200);
    }
}
