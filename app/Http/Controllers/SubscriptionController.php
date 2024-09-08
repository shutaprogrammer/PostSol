<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        // subscription1ページのビューを返す処理
        return view('mypages.subscription1');
    }
}
