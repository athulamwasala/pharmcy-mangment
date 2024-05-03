<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Get the username and password from the request
        $credentials = $request->only('username', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // If authentication is successful, create a token for the user
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['token' => $token]);
        }

        // If authentication fails, return an unauthorized error
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // Delete all tokens associated with the user
        $request->user()->tokens()->delete();
        // Return a success message
        return response()->json(['message' => 'Logged out']);
    }
}
