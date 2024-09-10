<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Payjp\Charge;
use Payjp\Payjp;

class PaymentController extends Controller
{
    public function create()
    {
        return view('payment');
    }

    public function createCharge(Request $request)
    {
        Payjp::setApiKey(config('payjp.secret_key'));
        
        // クレカトークンが送られる(tok_xxxxxxxxxxxxxxxxxxxx)
        $token = $request->input('payjp-token');
        Charge::create(array(
            "card" => $token,
            "amount" => 1000,
            "currency" => 'jpy',
        ));
        return redirect()->route('mypages.subscription3');
    }

    public function Coincreate()
    {
        return view('payment');
    }

    public function CoinCharge(Request $request)
    {
        Payjp::setApiKey(config('payjp.secret_key'));
        
        // クレカトークンが送られる(tok_xxxxxxxxxxxxxxxxxxxx)
        $token = $request->input('payjp-token');
        Charge::create(array(
            "card" => $token,
            "amount" => 100,
            "currency" => 'jpy',
        ));
        return view('mypages.bmcoin3');
    }
}
