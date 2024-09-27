<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function logUser(Request $request)
    {
        // Validate input
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        // Try to find the user by email or username
        $credentials = [
            filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name' => $request->input('login'),
            'password' => $request->input('password'),
        ];

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            // Authentication passed
            $user = Auth::user(); // Get authenticated user

            // Return success and user data, including token if needed
            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $user->createToken('authToken')->plainTextToken // Using Sanctum for API tokens
            ], 200);
        }

        // Authentication failed
        return response()->json(['message' => 'Invalid credentials'], 401);
    }


}
