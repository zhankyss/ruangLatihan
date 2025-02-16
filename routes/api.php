<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreateUser;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrayerTimeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserWebController;

// Endpoint untuk login
Route::post('login', [AuthController::class, 'login'])->name('api.login');

// Endpoint untuk mendapatkan jadwal sholat berdasarkan lokasi & tanggal


// Middleware Sanctum untuk proteksi API
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('user', UserController::class);

    // Endpoint untuk logout
    Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');
});
