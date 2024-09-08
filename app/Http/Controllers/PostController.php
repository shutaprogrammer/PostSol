<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    function create()
    {
        return view ('posts.create_post');
    }

    function show()
    {
        return view ('posts.create_check');
    }

    public function index()
    {
        // 投稿一覧ページのビューを返す処理
        return view('posts.index');
    }
}
