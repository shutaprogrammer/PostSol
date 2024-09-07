<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    function create()
    {
        return view ('posts.create_post');
    }
}
