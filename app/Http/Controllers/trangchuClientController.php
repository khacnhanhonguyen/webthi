<?php

namespace App\Http\Controllers;

use App\Models\DeThi;
use Illuminate\Http\Request;

class trangchuClientController extends Controller
{
    public function showtrangchu(){
        $dethis = DeThi::all();
        return view("client.trangchu",compact('dethis'));
    }
    public function showtrangthamgia(){
        $deThiList = DeThi::all();
        return view("client.thamgia",compact('deThiList'));
    }
}
