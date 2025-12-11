<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'error'   => 'Invalid credentials'
            ], 401);
        }

        $user = auth()->user();

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'token'   => $token
        ]);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
