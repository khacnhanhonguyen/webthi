<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class trangchuClientController extends Controller
{
    public function showtrangchu(){
        return view("client.trangchu");
    }
}
