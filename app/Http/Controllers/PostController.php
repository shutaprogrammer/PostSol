<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    
    function index() 
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
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

    function show()
    {
        return view ('posts.create_check');
    }
}
