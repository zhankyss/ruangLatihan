<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\PrayerTimeController;
use App\Http\Controllers\userController;
use App\Http\Controllers\userWebConntroller;


Route::get('prayer-time/{location}/{date}', [PrayerTimeController::class, 'index']);

Route::post('login', [authController::class, 'login'])->name('api.login');

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function (Request $request){
        return $request->user();
    });
    Route::apiResource('user', userController::class);

    Route::post('logout', [authController::class, 'logout'])->name('api.logout');

    
});
