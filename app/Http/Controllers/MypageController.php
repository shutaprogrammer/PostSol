<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function index()
    {
        // マイページのビューを返す処理
        return view('mypages.mypage');
    }
}
