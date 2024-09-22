<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Coin;

class BookmarkController extends Controller
{
    public function store(Post $post)
    {
        $user = Auth::user();
        $postOwner = $post->user;
        $userCoinAmount = $user->coins->sum('amount');

        if ($userCoinAmount < 10) {
            
            return redirect()->route('posts.index')->with('alert', [
                'post_id' => $post->id,
                'message' => 'ブックマークコインが不足しています'
            ]);
        }

        DB::transaction(function () use ($user, $post, $postOwner) {
            Coin::create([
                'user_id' => $user->id,  
                'amount' => -10,         
            ]);

            Coin::create([
                'user_id' => $postOwner->id,  
                'amount' => 10,         
                ]);

                Bookmark::create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ]);
                });

        return response()->json([
            'success' => true,
        'message' => 'ブックマークが追加されました！'
        ]);
    }

}


