<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopController extends Controller
{
    public function index()
    {
        // アンケートページのビューを返す処理
        return view('tops.question');
    }
}
