<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; // Add this line

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Register a new user
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully!'], 201);
    }

    // Log in the user
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) { // Change to Auth::attempt
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::user(); // Also change this to Auth::user()
        $token = $user->createToken('Personal Access Token')->accessToken;

        return response()->json(['token' => $token], 200);
    }


    // Log out the user
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['message' => 'User logged out successfully!'], 200);
    }
}
