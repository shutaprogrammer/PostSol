<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Coin;

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

    function index3(Request $request)
    {
        $coinCount = $request->coin_count;
        $price = $request->price;

        return view('mypages.bmcoin3', compact('coinCount', 'price'));
    }

    function CoinComplete100()
    {
        $user = Auth::user();
        Coin::create([
            'user_id' => $user->id,  
            'amount' => 100,         
            ]);

        return redirect()->route('mypages.mypage');
    }
    function CoinComplete200()
    {
        $user = Auth::user();
        Coin::create([
            'user_id' => $user->id,  
            'amount' => 200,         
            ]);

        return redirect()->route('mypages.mypage');
    }
    function CoinComplete300()
    {
        $user = Auth::user();
        Coin::create([
            'user_id' => $user->id,  
            'amount' => 300,         
            ]);

        return redirect()->route('mypages.mypage');
    }
    function CoinComplete400()
    {
        $user = Auth::user();
        Coin::create([
            'user_id' => $user->id,  
            'amount' => 400,         
            ]);

        return redirect()->route('mypages.mypage');
    }
}
