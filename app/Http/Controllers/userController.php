<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class userController extends Controller
{
    public function Registration(Request $request) {
        $data = $request->validate([
            "name" => "required|string",
            "email" => "required|string|unique:users,email",
            "password" => "required|string|confirmed"
        ]);

        $data['password'] = bcrypt($data['password']);
        $user = new User();
        $user->fill($data)->save();

        $token = $user->createToken('covidStats')->plainTextToken;

        $response = [
            "user" => $user,
            "token" => $token
        ];

        return response($response, 201);
    }

    public function Logout(Request $request) {
        // just deletes all tokens
        auth()->user()->tokens()->delete();
        return response([
            "msg" => "User logged out"
        ], 200);
    }

    public function Login(Request $request) {
        $data = $request->validate([
            "email" => "required|string",
            "password" => "required|string"
        ]);

        if(User::where("email", $data['email'])->exists()) {
            // if email found
            $user = User::where("email", $data['email'])->first();

            if(!Hash::check($data['password'], $user->password)) {
                // if password is incorrect
                return response([
                    "msg" => "Incorrect password"
                ], 403);
            }

            // Login
            $token = $user->createToken('covidStats')->plainTextToken;
            $response = [
                "user" => $user,
                "token" => $token
            ];
            return response($response, 200);

        } else {
            // if Email not exists
            return response([
                "msg" => "Email not found"
            ], 404);
        }
        
    }

}
