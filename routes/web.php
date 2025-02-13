<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;


Route::middleware(['auth'])->group(function(){
    Route::get('/home', function () {
        $log = DB::table('users')->where('name', auth::user()->name)->first();
        return view('dashboard',['email'=> $log->name]);
    });
    Route::get('/', [homeController::class, 'pondokName']);
    Route::get('/home', [homeController::class, 'pondokName']);
});