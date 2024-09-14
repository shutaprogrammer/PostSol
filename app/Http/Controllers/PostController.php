<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Status;

class PostController extends Controller
{
    
    function index(Request $request) 
    {
        $user = auth()->user();
        // ユーザーのステータスを確認
        $freeuser= Status::where('user_id', $user->id)->where('status', 'Free')->exists();
    if ($freeuser) {
        // 無課金ユーザーは投稿数を5件に制限
        $posts = Post::withCount('bookmarks', 'likes')->latest()->take(5)->get();
    } else {
        // 課金ユーザーには全ての投稿を表示
        $posts = Post::withCount('bookmarks','likes')->latest()->get();
    }

    $types = ['食品', '飲料', 'コンビニ・小売店・量販店', '外食・出前・お弁当', '暮らし・住まい', '美容・健康', '服・アクセサリー',
            'デジタル・家電', 'アプリ・Webサービス', '生活関連サービス', '医療・福祉', '自動車', '宿泊・観光・レジャー',
            'アウトドア・スポーツ', '趣味・エンタメ', 'ペット', '人間関係', '教育', '仕事', '公共・交通', '政治・行政・国際・文化', 'その他'];
    $category = $request->category;
    if($category) {
        $posts = Post::where('category', $category)->get();
    } else {
        $posts = Post::all();
    }
        return view('posts.index', compact('posts','freeuser', 'types', 'category'));
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
