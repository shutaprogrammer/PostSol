<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Coin;
use Illuminate\Support\Facades\Auth;
use App\Models\Status;

class PostController extends Controller
{
    function index(Request $request)
    {
        $user = auth()->user();
        $freeuser = Status::where('user_id', $user->id)->where('status', 'Free')->exists();

        // 現在の日付を取得
        $now = now();

        // クエリビルダーの作成（共通部分）
        $query = Post::withCount(['bookmarks', 'likes'])
            ->where(function($query) use ($now) {
                $query->where('deletion_date', '>=', $now)
                      ->orWhereNull('deletion_date');
            })
            ->whereNull('deleted_at');

        // 無課金ユーザーの場合は投稿数を5件に制限
        if ($freeuser) {
            $query->take(5);
        }

        // カテゴリフィルタリング
        $category = $request->category;
        if ($category) {
            $query->where('category', $category);
        }

        // キーワードフィルタリング
        $keyword = $request->keyword;
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('place', 'like', "%{$keyword}%")
                      ->orWhere('content', 'like', "%{$keyword}%");
            });
        }

        // 並び替えの処理
        $arrange = $request->arrange;
        if ($arrange == '古い順') {
            $query->oldest();
        } elseif ($arrange == 'ブックマーク数順（延長含まない）') {
            $query->orderBy('bookmarks_count', 'desc');
        } else {
            // デフォルトで新規投稿順に並び替え
            $query->latest();
        }

        // クエリを実行して投稿を取得
        $posts = $query->get();

        // その他のデータ
        $types = ['食品', '飲料', 'コンビニ・小売店・量販店', '外食・出前・お弁当', '暮らし・住まい', '美容・健康',
                  '服・アクセサリー', 'デジタル・家電', 'アプリ・Webサービス', '生活関連サービス', '医療・福祉',
                  '自動車', '宿泊・観光・レジャー', 'アウトドア・スポーツ', '趣味・エンタメ', 'ペット',
                  '人間関係', '教育', '仕事', '公共・交通', '政治・行政・国際・文化', 'その他'];

        $orders = ['新規投稿順', '古い順', 'ブックマーク数順（延長含まない）'];

        return view('posts.index', compact('posts', 'freeuser', 'types', 'category', 'keyword', 'orders', 'arrange'));
    }

    function create()
    {
        return view('posts.create_post');
    }

    function check(Request $request)
    {
        $request->validate([
            'category' => ['required', 'string', 'max:255'],
            'place' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:255'],
        ]);

        $post_data = $request;
        return view('posts.create_check', compact('post_data'));
    }

    function store(Request $request)
    {
        if($request->input('back') == 'back') {
            return redirect()->route('posts.create')->withInput();
        }

        $post = new Post;
        $post->user_id = Auth::id();
        $post->category = $request->category;
        $post->place = $request->place;
        $post->content = $request->content;
        $post->deletion_date = now()->addDay();  // 1日後に削除設定
        $post->save();

        return redirect()->route('posts.index');
    }

    public function extend(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->back()->with('alert_error', '権限がありません。');
        }

        $userCoins = Coin::where('user_id', Auth::id())->sum('amount');
        if ($userCoins < 100) {
            return redirect()->back()->with('alert_error', 'コインが不足しています。');
        }

        Coin::create([
            'user_id' => Auth::id(),
            'amount' => -100,
        ]);

        $post->deletion_date = $post->deletion_date ? $post->deletion_date->addDay() : now()->addDay();
        $post->save();

        return redirect()->route('posts.index')->with('alert_success', '投稿の表示期間が延長されました。');
    }
}
