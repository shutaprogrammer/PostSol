<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index()
    {
        // マイページのビューを返す処理
        return view('mypages.mypage');
    }

    public function show()
    {
        // ログインしているユーザーの情報を取得
        $user = Auth::user();

        // mypage.blade.php にユーザー情報を渡す
        return view('mypages.mypage', compact('user'));
    }
}
