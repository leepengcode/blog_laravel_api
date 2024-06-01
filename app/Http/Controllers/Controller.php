<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // public function register(Request $request)
    // {
    //     $request->validate([
    //         "name" => 'required',
    //         "email" => 'required',
    //         "password" => 'required',

    //     ]);
    //     $user_exist = User::where('email', $request->email)->first();
    //     if ($user_exist) {
    //         return response([
    //             'message' => "Email already exist.",
    //             'success' => false
    //         ]);
    //     }
    //     $user = User::create($request->all());
    //     return response([
    //         'message' => "User create successfully.",
    //         'success' => true,
    //         'user' => $user
    //     ]);
    // }

    // public function login(Request $request)
    // {
    //     //Check empty user and respone message
    //     if (!$request->email && !$request->password) {
    //         return response([
    //             'message' => "email and password is required"
    //         ]);

    //     }

    //     //Query data from user 
    //     $user = User::where('email', $request->email)->first();

    //     //if have user 
    //     if ($user) {
    //         //if password that user input == password that request
    //         if ($user->password == $request->password) {
    //             //we create a Token  and respone back
    //             $access_token = $user->createToken('authToken')->plainTextToken;
    //             return response(['user' => $user, 'access_token' => $access_token]);

    //         }
    //     }
    //     //if empty user respone not found
    //     return response(['message' => 'user not found...']);
    // }
}
