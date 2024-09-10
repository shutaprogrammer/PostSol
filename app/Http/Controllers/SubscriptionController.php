<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use App\Models\Coin; 
use Illuminate\Support\Facades\DB;
use App\Models\Bookmark;
use App\Models\Like;
use App\Models\Post;

class SubscriptionController extends Controller
{
    public function index()
    {
        // 現在ログインしているユーザーのIDを取得
        $userId = Auth::id();

        // // user_idが現在ログインしているユーザーのIDのstatusレコードを取得
        $status = Status::where('user_id', $userId)->first();

        // subscription1ページのビューとステータスを返す処理
        return view('mypages.subscription1', ['status' => $status]);
    }

    public function index2()
    {
        return view('mypages.subscription2');
    }

    public function index3()
    {
        return view('mypages.subscription3');
    }

    public function complete(Request $request)
    {
        $userId = Auth::id();
        
        // 現在のユーザーのステータスを取得
        $status = Status::where('user_id', $userId)->first();

        if ($status) {

            // 現在のログインユーザーを取得
            $user = Auth::user();

            // 1.ステータスの更新
            $status->status = 'Paid Member'; // 必要なステータスに更新
            $status->save();

            // 2. 新しいコインレコードを作成して、amountに100を設定
            Coin::create([
            'user_id' => $user->id,  // ログインしているユーザーのIDを設定
            'amount' => 100,         // 100コインを追加
            ]);

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

            // 更新が成功した後、mypageビューにリダイレクト
            return view('mypages.mypage', compact('user', 'totalBookmarks', 'totalLikes', 'bookmarkedPosts', 'totalbookemarkedposts', 'status'));
        }

        // ステータスが見つからない場合のエラーハンドリング
        return redirect()->back()->withErrors(['msg' => 'ステータスの更新に失敗しました。']);
    }
}
