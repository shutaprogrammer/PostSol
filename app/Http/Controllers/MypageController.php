<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index()
    {
        // マイページのビューを返す処理
        $user = Auth::user();
        return view('mypages.mypage', compact('user'));
    }

    public function show()
    {
        // ログインしているユーザーの情報を取得
        $user = Auth::user();

        // mypage.blade.php にユーザー情報を渡す
        return view('mypages.mypage', compact('user'));
    }
}
