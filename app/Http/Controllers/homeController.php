<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function pondokName(){
        $data = User::all();
        return view('dashboard',['data' => $data,]);
    }

}
