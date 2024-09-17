<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bookmark;
use App\Models\User;
use App\Models\Post;

class RankingController extends Controller
{
    public function post(){
        $posts = Post::withCount('bookmarks') // ブックマークの数をカウント
                 ->orderBy('bookmarks_count', 'desc') // ブックマークの数でソート
                 ->where('created_at', '>=', now()->subDays(30)) // 直近30日間の投稿
                 ->take(10)
                 ->get();
        return view ('rankings.post', compact('posts'));
    }

    public function user(){
        // ユーザーごとのブックマーク総数を計算し、トップ10を取得
        $topUsers = User::select('users.id', 'users.name', \DB::raw('COUNT(bookmarks.id) as total_bookmarks'))
            ->join('posts', 'users.id', '=', 'posts.user_id')  // ユーザーと投稿を結合
            ->join('bookmarks', 'posts.id', '=', 'bookmarks.post_id')  // 投稿とブックマークを結合
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_bookmarks')  // ブックマーク数でソート
            ->take(10)  // トップ10
            ->get();
    
        return view('rankings.user', compact('topUsers'));
    }
}
