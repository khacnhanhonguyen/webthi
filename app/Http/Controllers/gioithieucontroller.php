<?php

namespace App\Http\Controllers;

use App\Models\DeThi;
use Illuminate\Http\Request;

class gioithieucontroller extends Controller
{
    //
    public function showtranggioithieu() {
        $deThi= DeThi::find(1);
        return view('client.gioithieu',compact('deThi'));
    }
}
