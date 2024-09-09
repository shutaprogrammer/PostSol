<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        Like::create([
            'user_id'=>Auth::id(),
            'post_id'=>$post->id
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        Like::where('user_id', Auth::id())->where('post_id', $post->id)->delete();
        return redirect()->route('posts.index');
    }
}
