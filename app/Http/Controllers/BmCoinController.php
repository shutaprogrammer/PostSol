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
        return view('mypages.bmcoin1');
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

            return view('mypages.mypage', compact('user', 'totalBookmarks', 'totalLikes', 'bookmarkedPosts', 'totalbookemarkedposts', 'status'));
    }
    function CoinComplete200()
    {
        $user = Auth::user();
        Coin::create([
            'user_id' => $user->id,  
            'amount' => 200,         
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

            return view('mypages.mypage', compact('user', 'totalBookmarks', 'totalLikes', 'bookmarkedPosts', 'totalbookemarkedposts', 'status'));
    }
    function CoinComplete300()
    {
        $user = Auth::user();
        Coin::create([
            'user_id' => $user->id,  
            'amount' => 300,         
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

            return view('mypages.mypage', compact('user', 'totalBookmarks', 'totalLikes', 'bookmarkedPosts', 'totalbookemarkedposts', 'status'));
    }
    function CoinComplete400()
    {
        $user = Auth::user();
        Coin::create([
            'user_id' => $user->id,  
            'amount' => 400,         
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

        return view('mypages.mypage', compact('user', 'totalBookmarks', 'totalLikes', 'bookmarkedPosts', 'totalbookemarkedposts', 'status'));
    }
}
