<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class createUser extends Controller
{
    public function create(Request $request){
        try {
            $request->validate([
                'name' =>'required|string|max:255',
                'email' =>'required|string|email|max:255s',
                'password' => 'required|min:8',
            ]);
        } catch(ValidationException) {
        session()->flash(' deleted successfully');
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,	
        ]);

        return response()->json([
            'message' => 'data' . $user->name . 'berhasil ditambahkan',
        ]);

        
    }
}
