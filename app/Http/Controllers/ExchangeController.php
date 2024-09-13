<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Coin;

class ExchangeController extends Controller
{
    function index()
    {
        //BMコイン総数を計算
        $totalCoins = Coin::where('user_id', Auth::id())->sum('amount');

        return view('mypages.exchange', compact('totalCoins'));
    }
}
