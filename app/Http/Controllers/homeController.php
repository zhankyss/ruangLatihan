<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\PrayerTimeService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $prayerTimeService;
    protected $timeNow;

    public function __construct(PrayerTimeService $prayerTimeService)
    {
        $this->prayerTimeService = $prayerTimeService; // Fix assignment
        $this->timeNow = date('Y-m-d');
    }

    public function pondokName()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data pengguna
        $data = User::query()->orderBy('id', 'desc')->paginate(10);
        $allData = User::limit(50)->get();

        // Ambil ID kota untuk waktu shalat
        $cityId = $this->prayerTimeService->getCityId('klaten');

        if (!$cityId) {
            return response()->json(['error' => 'City not found'], 404);
        }

        // Ambil waktu shalat
        $prayerTime = $this->prayerTimeService->getPrayerTimes($cityId, $this->timeNow);

        Log::info($prayerTime);

        // dd($prayerTime);

        return view('dashboard', ['data' => $data, 'allData' => $allData, 'prayerTime' => $prayerTime]);
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
