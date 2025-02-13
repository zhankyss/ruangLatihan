<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info("IUNI LOG 1");
        $user = User::all();
        Log::info("IUNI LOG 2");

        Log::info("IUNI LOG 3");        
        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        log::info("UINI LOG 4");
        try {
            $request->validate(
                [
                    'name' => 'required',
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
        log::info("UINI LOG 5");

        var_dump("OK INI RUNNING DISINI");

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,	
        ]);
        log::info("UINI LOG 6");

        return response()->json([
            'message' => 'Data' . $user->name . 'Berhasil Ditambahkan',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 900);
        } 

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if (!$user) {
            return response()->json([
               'message' => 'User not found',
            ], 900);
        }

        try {
            $dataUser = $user->validate([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
        } catch(ValidationException){ 
            return response()->json([
                'message' => 'Data' . $user->name . 'Data berhasi; diUpdate',
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'message' => $user->name . 'Berhasil diHapus',
        ]);
    }
}
