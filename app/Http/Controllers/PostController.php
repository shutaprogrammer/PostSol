<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    function index() 
    {
        // $posts = Post::all();
        $posts = Post::withCount('bookmarks','likes')->get();
        return view('posts.index', compact('posts'));
    }
    function create()
    {
        return view ('posts.create_post');
    }

    function store(Request $request)
    {
        //$requestに入っている値を、new Postでデータベースに保存するという記述
        $post = new Post;
         //左辺:テーブル、右辺が送られてきた値(formから送られてきたnameが入っている)
        $post -> user_id = Auth::id();
        $post -> category = $request -> category;
        $post -> place = $request -> place;
        $post -> content = $request -> content;

        $post -> save();

        return redirect()->route('posts.check');
    }

    function show()
    {
        return view ('posts.create_check');
    }
}
