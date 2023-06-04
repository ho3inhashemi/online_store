<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function login(LoginRequest $request)
    {
        $user = User::where('email' , $request->email)->first();

        if ( !$user || !Hash::check($request->password, $user->password) )
        {
            return failed_response(null , 401 , "No user found with these informations");
        }

        $accessToken = $user->createToken('myAppToken')->plainTextToken;

        return success_response((object) ['user' => new UserResource($user) , 'accessToken' => $accessToken] , 201 , 'Welcome back, '.$user->full_name.'! You are now logged in');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->all());
        $accessToken = $user->createToken('myAppToken')->plainTextToken;

        return success_response((object)['user' => new UserResource($user) , 'accessToken' => $accessToken] , 200 , "Congratulations! Your account has been created");
    }


    public function logOut()
    {
        auth()->user()->tokens()->delete();

        return success_response(null , 200 , 'Logout completed. See you next time!');
    }


}
