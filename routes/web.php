<?php

use App\Models\Pondok;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\userWebController;

Route::middleware(['auth'])->group(function () {

    // CASE 1

    Route::get('/home', function () {
        $log = DB::table('users')->where('name', Auth::user()->name)->first();
        return view('dashboard',['email'=> $log->name]);
    });

    // CASE 2

    Route::get('/home',[homeController::class, 'pondokName']);

    // Route::get('/', function () {
    //         return view('pages.dashboard');
    //     });

    Route::get('/',[homeController::class, 'pondokName']);

    Route::resource('users', userWebController::class);
});
