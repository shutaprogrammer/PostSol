<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Amazon;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.menu');
    }

    public function malicious()
    {
        return view('admin.malicious');
    }

    public function exchange()
    {
        $gifts = Amazon::all();
        return view('admin.exchange',['gifts' => $gifts]);
    }

    public function inbox()
    {
        return view('admin.inbox');
    }
}
