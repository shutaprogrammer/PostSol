<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BmCoinController extends Controller
{
    function exchange(){
        return view('mypages.exchange');
    }

    function index1()
    {
        return view('mypages.bmcoin1');
    }

    function index2(Request $request)
    {
        $coinCount = $request->coin_count;
        $price = $request->price;

        return view('mypages.bmcoin2', compact('coinCount', 'price'));
    }

    function index3()
    {
        return view('mypages.bmcoin3');
    }
}
