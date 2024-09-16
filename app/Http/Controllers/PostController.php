<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Status;

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
    $freeuser = Status::where('user_id', $user->id)->where('status', 'Free')->exists();
    
    // クエリビルダーを最初に作成
    $count = Post::withCount(['bookmarks', 'likes']);
    
    // 並び順の処理
    $arrange = $request->arrange;
    if ($arrange == '古い順') {
        $count->oldest();
    } elseif ($arrange == 'ブックマーク数順（延長含まない）') {
        $count->orderBy('bookmarks_count', 'desc');
    } else {
        $count->latest(); // デフォルトは新規投稿順
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

        $post -> save();

        return redirect()->route('posts.index') ;
    }

}
