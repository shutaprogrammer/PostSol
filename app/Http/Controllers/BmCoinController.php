<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BmCoinController extends Controller
{
    function exchange(){
        return view('mypages.exchange');
    }
}
