<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function pondokName(){
        $data =
            DB::table('users')->orderBy('id', 'desc')
            ->paginate(10);

        $allData = User::all();

        return view('dashboard', ['alldata' => $allData, 'data' => $data]);
    }
}
