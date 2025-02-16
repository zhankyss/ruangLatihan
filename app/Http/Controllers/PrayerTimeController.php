<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PrayerTimeService;

class PrayerTimeController extends Controller
{
    protected $prayerTimeService;

    public function __construct(PrayerTimeService $prayerTimeService)
    {
        $this->prayerTimeService = $prayerTimeService;
    }

    public function index($city, $date)
    {
        $cityId = $this->prayerTimeService->getCityId($city);
        if(!$cityId){
            return response()->json(['error' => 'City not found'], 404);
        }

        $prayerTimes = $this->prayerTimeService->getPrayerTimes($cityId, $date);

        return response()->json($prayerTimes);
    }
}
