<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    function index()
    {
        return view('mypages.exchange');
    }
}
