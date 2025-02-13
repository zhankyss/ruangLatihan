<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function pondokName(){
        $data = User::all();
        return view('pages.dashbord', ['data' => $data,]);
    }
}
