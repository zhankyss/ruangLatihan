<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\PrayerService;

class HomeController extends Controller
{
    public function pondokName()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data pengguna
        $data = User::query()->orderBy('id', 'desc')->paginate(10);
        $allData = User::limit(50)->get();


        return view('dashboard', [
            'name'         => $user->name,
            'alldata'      => $allData,
            'data'         => $data,
        ]);
    }

    public function create()
    {
        return view('auth'); 
    }

    public function backHome()
    {
        return redirect()->route('home');
    }
}
