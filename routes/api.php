<?php

use App\Http\Controllers\authController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;


Route::post('login', [authController::class, 'login'])->name('api.login');

Route::middleware(['auth:sactum'])->group(function(){
    Route::get('/user', function (Request $request){
        return $request->user();
    });

    Route::apiResource('user', userController::class);

    Route::post('logout', [authController::class, 'logout'])->name('api.logout');
});
