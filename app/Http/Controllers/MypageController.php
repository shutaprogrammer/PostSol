<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bookmark;
use App\Models\Like;
use App\Models\Post;
use App\Models\Status;

class MypageController extends Controller
{
    // public function index()
    // {
    //     // マイページのビューを返す処理
    //     $user = Auth::user();
    //     return view('mypages.mypage', compact('user'));
    // }

    public function show()
    {
        // ログインしているユーザーの情報を取得
        $user = Auth::user();
        // 現在ログインしているユーザーのブックマークといいねの総数を取得
        $totalBookmarks = Bookmark::where('user_id', Auth::id())->count();
        $totalLikes = Like::where('user_id', Auth::id())->count();

        // ブックマークした投稿のIDを取得
        $bookmarkedPostIds = Bookmark::where('user_id', Auth::id())
        ->pluck('post_id'); 

        // ブックマークした投稿を取得
        $bookmarkedPosts = Post::whereIn('id', $bookmarkedPostIds)->get();

        $totalbookemarkedposts = $bookmarkedPosts->count();

        // 現在ログインしているユーザーのIDを取得
        $userId = Auth::id();

        // // user_idが現在ログインしているユーザーのIDのstatusレコードを取得
        $status = Status::where('user_id', $userId)->first();

        // mypage.blade.php にユーザー情報を渡す
        return view('mypages.mypage', compact('user', 'totalBookmarks', 'totalLikes', 'bookmarkedPosts', 'totalbookemarkedposts','status'));
    }

    public function edit($id)
    {
        $user = Auth::user();

        return view('mypages.edit_profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        
        $user->img = $request->img;
        $user->gender = $request->gender;
        $user->birth = $request->birth;
        $user->country = $request->country;
        $user->prefecture = $request->prefecture;
        $user->city = $request->city;

        if(request('img')) {
            $original = request()->file('img')->getClientOriginalName();
            $name = date('Ymd_His'). '_' . $original;
            request()->file('img')->move('storage/imgs', $name);
            $user->img = $name;
        }

        $user->save();

        return redirect()->route('mypages.mypage');
    }
    }

