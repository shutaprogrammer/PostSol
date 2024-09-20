<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Coin;
use App\Models\Bookmark;
use App\Models\Like;
use App\Models\Status;
use App\Models\Post;
use App\Models\Ad;


class BmCoinController extends Controller
{
    function index1()
    {
        //BMコイン総数を計算
        $totalCoins = Coin::where('user_id', Auth::id())->sum('amount');
        return view('mypages.bmcoin1',compact('totalCoins'));
    }

    function index2(Request $request)
    {
        $coinCount = $request->coin_count;
        $price = $request->price;

        return view('mypages.bmcoin2', compact('coinCount', 'price'));
    }

    function index3(Request $request)
    {
        $coinCount = $request->coin_count;
        $price = $request->price;

        return view('mypages.bmcoin3', compact('coinCount', 'price'));
    }

    function CoinComplete100()
    {
        $user = Auth::user();
        Coin::create([
            'user_id' => $user->id,  
            'amount' => 100,         
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
        }
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
            return view('mypages.mypage', compact('user', 'totalBookmarks', 'totalLikes', 'bookmarkedPosts', 'totalbookemarkedposts', 'status','totalCoins','freeuser', 'remainingTime', 'paidRemainingTime', 'ads'));
    }
    function CoinComplete200()
    {
        $user = Auth::user();
        Coin::create([
            'user_id' => $user->id,  
            'amount' => 200,         
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
            }
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
            return view('mypages.mypage', compact('user', 'totalBookmarks', 'totalLikes', 'bookmarkedPosts', 'totalbookemarkedposts', 'status','totalCoins','freeuser', 'remainingTime', 'paidRemainingTime', 'ads'));
    }
    function CoinComplete300()
    {
        $user = Auth::user();
        Coin::create([
            'user_id' => $user->id,  
            'amount' => 300,         
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
            }
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
            return view('mypages.mypage', compact('user', 'totalBookmarks', 'totalLikes', 'bookmarkedPosts', 'totalbookemarkedposts', 'status','totalCoins','freeuser', 'remainingTime', 'paidRemainingTime', 'ads'));
    }
    function CoinComplete400()
    {
        $user = Auth::user();
        Coin::create([
            'user_id' => $user->id,  
            'amount' => 400,         
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
            }

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
            return view('mypages.mypage', compact('user', 'totalBookmarks', 'totalLikes', 'bookmarkedPosts', 'totalbookemarkedposts', 'status','totalCoins','freeuser', 'remainingTime', 'paidRemainingTime', 'ads'));
        
    }
}
