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
use App\Models\Ad;
use App\Models\Message;

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
            $status->period = now()->addMonth(); // 1ヶ月後の期限を設定
            $status->save();

            // 2. 新しいコインレコードを作成して、amountに100を設定
            Coin::create([
            'user_id' => $user->id,  // ログインしているユーザーのIDを設定
            'amount' => 100,         // 100コインを追加
            ]);

            // ログインしているユーザーの情報を取得
            $user = Auth::user();
            $freeuser= Status::where('user_id', $user->id)->where('status', 'Free')->exists();
        if ($freeuser){
            // 現在ログインしているユーザーの投稿に対して付けられたブックマークの総数を取得
        $totalBookmarks = Bookmark::whereIn('post_id', function($query) {
            $query->select('id')->from('posts')->where('user_id', Auth::id());
        })->count();
        
        // 現在ログインしているユーザーの投稿に対して付けられたいいねの総数を取得
        $totalLikes = Like::whereIn('post_id', function($query) {
            $query->select('id')->from('posts')->where('user_id', Auth::id());
        })->count();

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

        //BMコイン総数を計算
        $totalCoins = Coin::where('user_id', Auth::id())->sum('amount');
        }else{
            // 現在ログインしているユーザーの投稿に対して付けられたブックマークの総数を取得
        $totalBookmarks = Bookmark::whereIn('post_id', function($query) {
            $query->select('id')->from('posts')->where('user_id', Auth::id());
        })->count();
        
        // 現在ログインしているユーザーの投稿に対して付けられたいいねの総数を取得
        $totalLikes = Like::whereIn('post_id', function($query) {
            $query->select('id')->from('posts')->where('user_id', Auth::id());
        })->count();

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

        //BMコイン総数を計算
        $totalCoins = Coin::where('user_id', Auth::id())->sum('amount');

        //トライアル期間
        $trialStatus = Status::where('user_id', Auth::id())->where('status', 'Trial')->first();
        $remainingTime = null;

        if ($trialStatus) {
            $remainingDays = now()->diffInDays($trialStatus->period);
            $remainingHours = now()->diffInHours($trialStatus->period) % 24;
            $remainingMinutes = now()->diffInMinutes($trialStatus->period) % 60;
            $remainingTime = "{$remainingDays}日 {$remainingHours}時間 {$remainingMinutes}分";
        }
        // Paid Memberの残り期間
        $paidStatus = Status::where('user_id', Auth::id())->where('status', 'Paid Member')->first();
        $paidRemainingTime = null;
        
        if ($paidStatus) {
            $remainingPaidDays = now()->diffInDays($paidStatus->period);
            $remainingPaidHours = now()->diffInHours($paidStatus->period) % 24;
            $remainingPaidMinutes = now()->diffInMinutes($paidStatus->period) % 60;
            $paidRemainingTime = "{$remainingPaidDays}日 {$remainingPaidHours}時間 {$remainingPaidMinutes}分";
        }
        // 広告データのサンプル
        $ads = Ad::all();  // 全ての広告を取得

        //未読DM
        $unreadMessagesCount = Message::join('conversations', 'messages.conversation_id', '=', 'conversations.id')
        ->where(function($query) {
            $query->where('conversations.user_one_id', Auth::id())
                  ->orWhere('conversations.user_two_id', Auth::id());
        })
        ->where('messages.sender_id', '!=', Auth::id())
        ->where('messages.is_read', false)
        ->latest()
        ->count();

            return view('mypages.mypage', compact('user', 'totalBookmarks', 'totalLikes', 'bookmarkedPosts', 'totalbookemarkedposts', 'status','totalCoins','freeuser', 'remainingTime','paidRemainingTime', 'ads', 'unreadMessagesCount'));
        }

        // ステータスが見つからない場合のエラーハンドリング
        return redirect()->back()->withErrors(['msg' => 'ステータスの更新に失敗しました。']);
    }
}
}