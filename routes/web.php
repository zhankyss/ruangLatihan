<?php

use App\Http\Controllers\createUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\userWebConntroller;


Route::middleware(['auth'])->group(function(){
    // Route::get('/home', function () {
    //     $log = DB::table('users')->where('name', auth::user()->name)->first();
    //     return view('dashboard',['email'=> $log]);
    // });
    Route::get('/', [homeController::class, 'pondokName'])->name('home');
    Route::get('/home', [homeController::class, 'pondokName']);
    Route::get('/create', [homeController::class, 'create'])->name('create');
    Route::get('/backHome', [homeController::class, 'backHome'])->name('backHome');
    Route::post('/users', [userWebConntroller::class, 'store'])->name('users.store');
    Route::resource('userWeb', userWebConntroller::class);
    Route::resource('userCreate', createUser::class);
});