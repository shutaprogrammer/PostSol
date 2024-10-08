<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bookmark;
use App\Models\Like;
use App\Models\Post;
use App\Models\Status;
use App\Models\Coin;
use App\Models\Ad;
use App\Models\Message;

class MypageController extends Controller
{
    public function show()
    {
        // ログインしているユーザーの情報を取得
        $user = Auth::user();
        $freeuser= Status::where('user_id', $user->id)->where('status', 'Free')->exists();
         // 投稿者IDを含めてブックマークした投稿を取得
        $bookmarkedPostIds = Bookmark::where('user_id', Auth::id())->pluck('post_id'); 
        $bookmarkedPosts = Post::withTrashed()->whereIn('id', $bookmarkedPostIds)->get();
        
        foreach ($bookmarkedPosts as $post) {
            $post->author_id = $post->user_id; // 投稿者のユーザー ID を追加
        }
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
        $bookmarkedPosts = Post::withTrashed()->whereIn('id', $bookmarkedPostIds)->get();

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
        $bookmarkedPosts = Post::withTrashed()->whereIn('id', $bookmarkedPostIds)->get();

        $totalbookemarkedposts = $bookmarkedPosts->count();

        // 現在ログインしているユーザーのIDを取得
        $userId = Auth::id();

        // // user_idが現在ログインしているユーザーのIDのstatusレコードを取得
        $status = Status::where('user_id', $userId)->first();

        //BMコイン総数を計算
        $totalCoins = Coin::where('user_id', Auth::id())->sum('amount');

    }

         // 広告データのサンプル
         $ads = Ad::all();  // 全ての広告を取得

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

        // mypage.blade.php にユーザー情報を渡す
        return view('mypages.mypage', compact('user', 'totalBookmarks', 'totalLikes', 'bookmarkedPosts', 'totalbookemarkedposts','status','totalCoins','freeuser', 'ads', 'remainingTime', 'paidRemainingTime', 'unreadMessagesCount'));
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

