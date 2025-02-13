<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class authController extends Controller
{
    public function login(Request $request) {
        try {
            $validate = $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ]);
        }

        $user = User::where('email', $validate['email'])->first();

        Log::info("$user");

        if (!$user || !Hash::check($validate['password'], $user->password)){
            return response()->json([
                'message' => 'email or passsword not valid',
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'message' => 'Login Berhasil',
            'token' => $token,
        ]);
    }

    public function logout(Request $request){
        $user = $request->user();

        $user->tokens()->delete();

        return response()->json([
            'message' => $user->name . 'Behasil Logout',
        ]);
    }
}
