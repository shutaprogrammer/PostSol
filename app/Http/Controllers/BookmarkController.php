<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Coin;


// class BookmarkController extends Controller
// {

//     public function store(Post $post)
//     {
//         $user = Auth::user();
        // $postOwner = $post->user;

        // DB::transaction(function () use ($user, $postOwner) {
        //     // 1. ブックマークをしたユーザーのコインを-10する
        //     $userCoin = $user->coins()->first(); // 現在のユーザーの最初のコインレコードを取得
        //         $userCoin->amount -= 10;
        //         $userCoin->save();

        //     // 2. ブックマークされた投稿の所有者のコインを+10する
        //     $postOwnerCoin = $postOwner->coins()->first(); // 投稿の所有者の最初のコインレコードを取得
        //         $postOwnerCoin->amount += 10;
        //         $postOwnerCoin->save();

    //         Bookmark::create([
    //             'user_id' => Auth::id(),
    //             'post_id' =>$post->id,
    //         Coin::create([
    //                 'user_id' => $user->id,  // ログインしているユーザーのIDを設定
    //                 'amount' => -10,         // 100コインを追加
    //         ]);
                
    //         ]);
    //     };

    //     return redirect()->route('posts.index');
    // }

    // public function destroy(Post $post)
    // {
    //     Bookmark::where('user_id', Auth::id())->where('post_id', $post->id)->delete();
    //     return redirect()->route('posts.index');
    // }

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

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        Bookmark::where('user_id', Auth::id())
            ->where('post_id', $post->id)
            ->delete();

        return redirect()->route('posts.index');
    }
}


