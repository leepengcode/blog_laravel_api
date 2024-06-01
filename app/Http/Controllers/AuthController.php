<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //Check validete(ឆែកថាវាត្រូវតែបញ្ចូល)
        $request->validate([
            "name" => 'required',
            "email" => 'required',
            "password" => 'required',

        ]);

        //Check if email already exist
        $user_exist = User::where('email', $request->email)->first();
        if ($user_exist) {
            return response([
                'message' => "Email already exist.",
                'success' => false
            ]);
        }
        // Covert password to unknow text in database
        $hashedPassword = Hash::make($request->password);
        // $user = User::create($request->all());
        $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $hashedPassword,
            ]

        );
        return response([
            'message' => "User create successfully.",
            'success' => true,
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        //Check empty user and respone message

        // $request->validate([
        //     "email" => 'required',
        //     "password" => 'required',
        // ]);

        if (!$request->email && !$request->password) {
            return response([
                'message' => "email and password is required"
            ]);

        }

        //Query data from user 
        $user = User::where('email', $request->email)->first();

        //if have user 
        if (!$user) {
            //if password that user input == password that request
            return response(
                [
                    'message' => 'User not found',
                    'success' => false
                ]
            );
        }

        if (Hash::check($request->password, $user->password)) {
            //we create a Token  and respone back
            $access_token = $user->createToken('authToken')->plainTextToken;
            return response([
                'message' => 'Login successfully',
                'sucsess' => true,
                'user' => $user,

                'access_token' => $access_token
            ]);

        }
        //if empty user respone not found
        return response(['message' => 'Password not correct...', 'sucsess' => false]);
    }
}
