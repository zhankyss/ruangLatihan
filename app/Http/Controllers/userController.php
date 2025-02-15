<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();

        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ]);
        }

        var_dump("ok ini running disini");

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,	
        ]);

        return response()->json([
            'message' => 'data' . $user->name . 'berhasil ditambahkan',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        if(!$user) {
            return response()->json([
                'message' => 'data not found'
            ]);
        } 

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if(!$user) {
            return response()->json([
               'message' => 'data not found'
            ]);
        }

        try {
            $dataUser = $request->validate([
                'name' =>'required',
                'email' =>'required',
                'password' => 'nullable',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ]); 
        }

        $user->update($dataUser);

        return response()->json([
           'message' => 'data user '. $user->name.'berhasil diupdate'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrfail($id);

       if(!$user){
        return response()->json([
            'message' => 'data not found',
        ], 400);

       }

        $user->delete();

        return response()->json([
            'message' => 'data user '. $user->name.'berhasil dihapus'
        ]);
    }
}
