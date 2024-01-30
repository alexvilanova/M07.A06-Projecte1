<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TokenController extends Controller
{
    public function user(Request $request)
    {
        $user = User::where('email', $request->user()->email)->first();
       
        return response()->json([
            "success" => true,
            "user"    => $request->user(),
            "roles"   => $user->role(),
        ]);
    }
 
    public function register(Request $request) {
        $credentials = $request->validate([
            'name'     => 'required',
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        if ($credentials) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => \Hash::make($request->password),
            ]);
            $token = $user->createToken("authToken")->plainTextToken;

            return response()->json([
                'success' => true,
                'authToken' => $token,
                'tokenType' => 'Bearer',
            ], 200);    
        } else {
            return response()->json([
                'message' => 'datos requeridos'
            ], 500);
        }

    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);
        if (\Auth::attempt($credentials)) {
            // Get user
            $user = User::where([
                ["email", "=", $credentials["email"]]
            ])->firstOrFail();
            // Revoke all old tokens
            $user->tokens()->delete();
            // Generate new token
            $token = $user->createToken("authToken")->plainTextToken;
            // Token response
            return response()->json([
                "success"   => true,
                "authToken" => $token,
                "tokenType" => "Bearer"
            ], 200);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Invalid login credentials"
            ], 401);
        }
    }
    public function logout(Request $request) 
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Successfully logout'
        ], 200);
    }
}
