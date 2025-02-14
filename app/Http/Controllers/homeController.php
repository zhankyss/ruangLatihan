<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function pondokName()
    {
        $user = Auth::user();

        // Cek apakah user ditemukan (untuk mencegah error)
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data pengguna dengan pagination
        $data = DB::table('users')->orderBy('id', 'desc')->paginate(10);

        // Ambil semua data pengguna
        $allData = User::all();

        return view('dashboard', [
            'name'    => $user->name,
            'alldata' => $allData,
            'data'    => $data
        ]);
    }
}
