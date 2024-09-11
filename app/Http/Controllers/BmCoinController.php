<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Coin;
use App\Models\Bookmark;
use App\Models\Like;
use App\Models\Status;
use App\Models\Post;


class BmCoinController extends Controller
{
    function exchange(){
        return view('mypages.exchange');
    }

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

            return view('mypages.mypage', compact('user', 'totalBookmarks', 'totalLikes', 'bookmarkedPosts', 'totalbookemarkedposts', 'status','totalCoins'));
    }
    function CoinComplete200()
    {
        $user = Auth::user();
        Coin::create([
            'user_id' => $user->id,  
            'amount' => 200,         
            ]);

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

            return view('mypages.mypage', compact('user', 'totalBookmarks', 'totalLikes', 'bookmarkedPosts', 'totalbookemarkedposts', 'status','totalCoins'));
    }
    function CoinComplete300()
    {
        $user = Auth::user();
        Coin::create([
            'user_id' => $user->id,  
            'amount' => 300,         
            ]);

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

            return view('mypages.mypage', compact('user', 'totalBookmarks', 'totalLikes', 'bookmarkedPosts', 'totalbookemarkedposts', 'status','totalCoins'));
    }
    function CoinComplete400()
    {
        $user = Auth::user();
        Coin::create([
            'user_id' => $user->id,  
            'amount' => 400,         
            ]);

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

        return view('mypages.mypage', compact('user', 'totalBookmarks', 'totalLikes', 'bookmarkedPosts', 'totalbookemarkedposts', 'status','totalCoins'));
    }
}
