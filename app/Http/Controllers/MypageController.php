<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bookmark;
use App\Models\Like;

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
        // 現在ログインしているユーザーのブックマークといいねの総数を取得
        $totalBookmarks = $user->bookmarks()->count();
        $totalLikes = $user->likes()->count();

        // mypage.blade.php にユーザー情報を渡す
        return view('mypages.mypage', compact('user', 'totalBookmarks', 'totalLikes'));
    }
}
