<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Coin;
use Illuminate\Support\Facades\Auth;
use App\Models\Status;
use Carbon\Carbon; // 追加

class PostController extends Controller
{
    
    // function index(Request $request) 
    // {
    //     $user = auth()->user();
    //     // ユーザーのステータスを確認
    //     $freeuser= Status::where('user_id', $user->id)->where('status', 'Free')->exists();

    //     if ($freeuser) {
    //         // 無課金ユーザーは投稿数を5件に制限
    //         $posts = Post::withCount(['bookmarks', 'likes'])->latest()->take(5)->get();
    //     } else {
    //         // 課金ユーザーには全ての投稿を表示
    //         $posts = Post::withCount(['bookmarks', 'likes'])->latest()->get();
    //     }

    // $types = ['食品', '飲料', 'コンビニ・小売店・量販店', '外食・出前・お弁当', '暮らし・住まい', '美容・健康', '服・アクセサリー',
    //         'デジタル・家電', 'アプリ・Webサービス', '生活関連サービス', '医療・福祉', '自動車', '宿泊・観光・レジャー',
    //         'アウトドア・スポーツ', '趣味・エンタメ', 'ペット', '人間関係', '教育', '仕事', '公共・交通', '政治・行政・国際・文化', 'その他'];

    // $category = $request->category;
    // $keyword = $request->keyword;

    // if($category) {
    //     $posts = Post::withCount(['bookmarks', 'likes'])->orderBy('created_at', 'desc')->where('category', $category)->get();
    // } elseif($keyword) {
    //     $posts = Post::withCount(['bookmarks', 'likes'])->where('place', 'like', "%{$keyword}%")
    //     ->orWhere('content', 'like', "%{$keyword}%")
    //     ->get();
    // } else {
    //     $posts = Post::withCount(['bookmarks', 'likes'])->orderBy('created_at', 'desc')->get();
    // }

    // $orders = ['新規投稿順', '古い順', 'ブックマーク数順（延長含まない）'];

    // $arrange = $request->arrange;
    // if($arrange == '古い順') {
    //     $posts = Post::withCount(['bookmarks', 'likes'])->oldest()->get();
    // } elseif ($arrange == 'ブックマーク数順（延長含まない）') {
    //     $posts = Post::withCount(['bookmarks', 'likes'])->orderBy('bookmarks_count', 'desc')->get();
    // } 
    //     return view('posts.index', compact('posts', 'freeuser', 'types', 'category', 'keyword', 'orders', 'arrange'));
    // }

    function index(Request $request) 

    {
        $user = auth()->user();
        // ユーザーのステータスを確認
        $freeuser= Status::where('user_id', $user->id)->where('status', 'Free')->exists();

        // 現在の日付を取得
        $now = now();
        // クエリビルダーを最初に作成
        $count = Post::withCount(['bookmarks', 'likes']);
    if ($freeuser) {
        // 無課金ユーザーは投稿数を5件に制限
        $count->where(function($query) use ($now) {
            $query->where('deletion_date', '>=', $now)
                  ->orWhereNull('deletion_date');
        })
        ->whereNull('deleted_at')->latest()->take(5)->get();
    } else {
        // 課金ユーザーには全ての投稿を表示
        $count->where(function($query) use ($now) {
            $query->where('deletion_date', '>=', $now)
                  ->orWhereNull('deletion_date');
        })
        ->whereNull('deleted_at')->latest()->get();
    
    }

    // カテゴリでのフィルタリング
    $category = $request->category;
    if ($category) {
        $count->where('category', $category);
    }

    // キーワードでのフィルタリング
    $keyword = $request->keyword;
    if ($keyword) {
        $count->where(function ($query) use ($keyword) {
            $query->where('place', 'like', "%{$keyword}%")
                ->orWhere('content', 'like', "%{$keyword}%");
        });
    }


    if($category) {
        $count->where('category', $category)
        ->where(function($query) use ($now) {
            $query->where('deletion_date', '>=', $now)
                  ->orWhereNull('deletion_date');
        })
        ->whereNull('deleted_at')->latest()->get();
    } elseif($keyword) {
        $count->where(function ($query) use ($keyword) {
                $query->where('place', 'like', "%{$keyword}%")
                      ->orWhere('content', 'like', "%{$keyword}%");
            })
            ->where(function($query) use ($now) {
                $query->where('deletion_date', '>=', $now)
                      ->orWhereNull('deletion_date');
            })
            ->whereNull('deleted_at')
            ->latest()
            ->get();
    } else {
        $count->where(function($query) use ($now) {
                $query->where('deletion_date', '>=', $now)
                      ->orWhereNull('deletion_date');
            })
            ->whereNull('deleted_at')
            ->latest()
            ->get();

    // 無課金ユーザーなら投稿数を5件に制限
    if ($freeuser) {
        $count->take(5);
    }

    // クエリを実行して投稿を取得
    $posts = $count->get();

    $types = ['食品', '飲料', 'コンビニ・小売店・量販店', '外食・出前・お弁当', '暮らし・住まい', '美容・健康', 
                '服・アクセサリー', 'デジタル・家電', 'アプリ・Webサービス', '生活関連サービス', '医療・福祉', 
                '自動車', '宿泊・観光・レジャー', 'アウトドア・スポーツ', '趣味・エンタメ', 'ペット', 
                '人間関係', '教育', '仕事', '公共・交通', '政治・行政・国際・文化', 'その他'];

    $orders = ['新規投稿順', '古い順', 'ブックマーク数順（延長含まない）'];


    $arrange = $request->arrange;
    if($arrange == '古い順') {
        $count->where(function($query) use ($now) {
                $query->where('deletion_date', '>=', $now)
                      ->orWhereNull('deletion_date');
            })
            ->whereNull('deleted_at')
            ->oldest()
            ->get();
    } elseif ($arrange == 'ブックマーク数順（延長含まない）') {
        $count->where(function($query) use ($now) {
                $query->where('deletion_date', '>=', $now)
                      ->orWhereNull('deletion_date');
            })
            ->whereNull('deleted_at')
            ->orderBy('bookmarks_count', 'desc')
            ->get();
    } 
        return view('posts.index', compact('posts', 'freeuser', 'types', 'category', 'keyword', 'orders', 'arrange'));
    }


    function create()
    {
        return view ('posts.create_post');
    }

    function check(Request $request)
    {
        //バリーデーション
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
        // 戻るボタンをクリックされた場合
        if($request->input('back') == 'back' ){
            return redirect()->route('posts.create')->withInput();
        }

        //$requestに入っている値を、new Postでデータベースに保存するという記述
        $post = new Post;
         //左辺:テーブル、右辺が送られてきた値(formから送られてきたnameが入っている)
        $post -> user_id = Auth::id();
        $post -> category = $request -> category;
        $post -> place = $request -> place;
        $post -> content = $request -> content;

        // 作成日から30日後を削除予定日に設定
        // $post->deletion_date = now()->addDays(30);

        // 作成日から1日後を削除予定日に設定
        $post->deletion_date = now()->addDay();
        
        $post -> save();

        return redirect()->route('posts.index') ;
    }

    public function extend(Request $request, Post $post)
{
    // 投稿のオーナーであることを確認
    if ($post->user_id !== Auth::id()) {
        return redirect()->back()->with('alert_error', '権限がありません。');
    }

    // コインの確認
    $userCoins = Coin::where('user_id', Auth::id())->sum('amount');
    if ($userCoins < 100) {
        return redirect()->back()->with('alert_error', 'コインが不足しています。');
    }

    // コインの引き落とし
    Coin::create([
        'user_id' => Auth::id(),
        'amount' => -100,
    ]);

    // 投稿の表示期間を1日延長
    if ($post->deletion_date && $post->deletion_date > now()) {
        $post->deletion_date = $post->deletion_date->addDay(); // 既存の削除予定日があれば1日追加
    } else {
        $post->deletion_date = now()->addDay(); // 削除予定日がなければ1日後に設定
    }
    $post->save();

    return redirect()->route('posts.index')->with('alert_success', '投稿の表示期間が延長されました。');
}
}
