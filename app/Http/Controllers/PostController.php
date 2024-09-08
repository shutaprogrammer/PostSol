<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

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

    function show()
    {
        return view ('posts.create_check');
    }
}
